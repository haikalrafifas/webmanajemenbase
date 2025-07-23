<?php

namespace App\Http\Controllers;

use App\Models\CampusTask;
use App\Models\Activity;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Project;
use App\Models\ProjectSubmission;
use Carbon\Carbon;



class AnggotaController extends Controller
{
//   public function statistics()
// {
//     $now = Carbon::now();

//     // Leaderboard Sepanjang Masa
//     $leaderboardAllTime = Activity::selectRaw('user_id, SUM(score) as total_score')
//         ->groupBy('user_id')
//         ->with('user')
//         ->orderByDesc('total_score')
//         ->get();

//     // Leaderboard Bulan Ini
//     $leaderboardThisMonth = Activity::whereMonth('week_start_date', $now->month)
//         ->whereYear('week_start_date', $now->year)
//         ->selectRaw('user_id, SUM(score) as total_score')
//         ->groupBy('user_id')
//         ->with('user')
//         ->orderByDesc('total_score')
//         ->get();

//     // Leaderboard Minggu Ini
//     $startOfWeek = $now->copy()->startOfWeek(Carbon::MONDAY); // Mulai dari Senin
//     $endOfWeek = $now->copy()->endOfWeek(Carbon::SUNDAY);     // Sampai Minggu

//     $leaderboardThisWeek = Activity::whereBetween('week_start_date', [$startOfWeek, $endOfWeek])
//         ->selectRaw('user_id, SUM(score) as total_score')
//         ->groupBy('user_id')
//         ->with('user')
//         ->orderByDesc('total_score')
//         ->get();

//     return view('anggota.statistics', compact(
//         'leaderboardAllTime',
//         'leaderboardThisMonth',
//         'leaderboardThisWeek'
//     ));
// }
    public function detail($id)
{
    $project = Project::findOrFail($id); // Ambil 1 proyek berdasarkan id
    return view('anggota.detail', compact('project'));
}

public function storeCampusTask(Request $request)
{
    $request->validate([
        'mata_kuliah' => 'required|string|max:100',
        'tugas' => 'required|string|max:150',
        'deadline' => 'required|date',
        'status' => 'required|in:On-going,Done',
    ]);

    \App\Models\CampusTask::create([
        'user_id' => auth()->id(),
        'mata_kuliah' => $request->mata_kuliah,
        'tugas' => $request->tugas,
        'deadline' => $request->deadline,
        'status' => $request->status,
    ]);

    return redirect()->back()->with('success', 'Tugas berhasil ditambahkan!');
}

public function campusproject()
{
    $tasks = CampusTask::where('user_id', auth()->id())->get();
    return view('anggota.campusproject', compact('tasks'));
}

public function index()
{
    $user = auth()->user();

    // Ambil semua tugas kampus user
    $mataKuliah = CampusTask::where('user_id', $user->id)
                    ->orderBy('deadline', 'asc')
                    ->select('mata_kuliah', 'deadline')
                    ->get();

    // Ambil submissions user ini beserta relasi project
    $submissions = ProjectSubmission::with('project')
                    ->where('user_id', $user->id)
                    ->get();

    // Ambil semua skema dari project yg pernah user submit
    $skemas = $submissions->pluck('project.skema')->unique()->filter()->values();
$projects = Project::all(); // atau filter sesuai kebutuhan

// Tambahkan bagian ini:
    $now = Carbon::now();
    $taskProjects = Project::whereDate('deadline', '>=', $now->startOfMonth())
        ->orderBy('deadline')
        ->limit(3)
        ->get();

    // Jika < 3, tambahkan lagi dari yang lain
    if ($taskProjects->count() < 3) {
        $additional = Project::whereDate('deadline', '>', $now)
            ->whereNotIn('id', $taskProjects->pluck('id'))
            ->orderBy('deadline')
            ->limit(3 - $taskProjects->count())
            ->get();

        $taskProjects = $taskProjects->merge($additional);
    }

  // ✅ Tambahkan ini sebelum compact()
    $penelitianCount = Project::where('skema', 'Penelitian')->count();
    $pengabdianCount = Project::where('skema', 'Pengabdian Kepada Masyarakat')->count();

    return view('anggota.index', compact('user', 'mataKuliah', 'submissions', 'skemas', 'projects', 'penelitianCount', 'pengabdianCount', 'taskProjects'));
    }

public function baseprojects()
{
    $userId = Auth::id();

    $projects = Project::all()->map(function ($project) use ($userId) {
        $request = DB::table('project_requests')
            ->where('user_id', $userId)
            ->where('project_id', $project->id)
            ->first(); // ambil data status, bukan cuma "exists"

        // Isi nilai statusnya (pending / accepted / rejected / null)
        $project->requested = $request ? $request->status : null;
        return $project;
    });

    return view('anggota.baseprojects', compact('projects'));
}

public function submitProject(Request $request, $project_id)
{
    $request->validate([
        'uraian' => 'required|string',
        'files.*' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
    ]);

    $fileNames = [];

    if ($request->hasFile('files')) {
        foreach ($request->file('files') as $file) {
            $fileName = time().'_'.$file->getClientOriginalName();
            $file->move(public_path('uploads'), $fileName);
            $fileNames[] = $fileName;
        }
    }

    ProjectSubmission::create([
        'user_id' => auth()->id(),
        'project_id' => $project_id,
        'uraian' => $request->uraian,
        'files' => $fileNames,
    ]);

    return redirect()->back()->with('success', 'Tugas berhasil dikirim!');
}

public function toggleCampusTaskStatus($id)
{
    $task = CampusTask::where('user_id', auth()->id())->findOrFail($id);

    $task->status = $task->status === 'On-going' ? 'Done' : 'On-going';
    $task->save();

    return redirect()->back()->with('success', 'Status tugas diperbarui.');
}

public function requestJoinProject($id)
{
    $userId = auth()->id();

    // Cek apakah user sudah request atau sudah tergabung
    $existing = DB::table('project_requests')
        ->where('project_id', $id)
        ->where('user_id', $userId)
        ->first();

    if (!$existing) {
        DB::table('project_requests')->insert([
            'project_id' => $id,
            'user_id' => $userId,
            'status' => 'pending',
            'created_at' => now(),
        ]);

        return back()->with('success', 'Permintaan bergabung berhasil dikirim!');
    }

    return back()->with('info', 'Kamu sudah mengirim permintaan sebelumnya.');
}

public function showWeeklyTasks($projectId)
{
    $userId = auth()->id();

    // Cek apakah user accepted di proyek ini
    $isMember = DB::table('project_requests')
        ->where('project_id', $projectId)
        ->where('user_id', $userId)
        ->where('status', 'accepted')
        ->exists();

    if (!$isMember) {
        abort(403);
    }

    $tasks = ProjectWeeklyTask::with(['submissions' => function ($q) use ($userId) {
        $q->where('user_id', $userId);
    }])->where('project_id', $projectId)
      ->orderBy('week_start_date', 'desc')
      ->get();

    return view('anggota.weekly_tasks', compact('tasks', 'projectId'));
}

public function submitWeeklyTask($task_id)
{
    $userId = auth()->id();

    // Cegah double submit
    $exists = ProjectWeeklyTaskSubmission::where('project_weekly_task_id', $task_id)
        ->where('user_id', $userId)
        ->exists();

    if (!$exists) {
        ProjectWeeklyTaskSubmission::create([
            'project_weekly_task_id' => $task_id,
            'user_id' => $userId,
            'submitted_at' => now(),
        ]);
    }

    return back()->with('success', 'Tugas ditandai selesai.');
}





}
