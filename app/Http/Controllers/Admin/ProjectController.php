<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Project;
use App\Models\ProjectUser;
use App\Models\ProjectSubmission;
use App\Models\ProjectWeeklyTask;
use Carbon\Carbon;



class ProjectController extends Controller
{
    public function store(Request $request) {
        // Validasi
        $validated = $request->validate([
            'nama_project' => 'required|string|max:255',
            'pic' => 'required|string|max:255',
            'fokus' => 'nullable|string|max:255',
            'skema' => 'nullable|string|max:100',
            'tahun' => 'nullable|integer',
            'start_date' => 'required|date', // Tambah validasi start_date
            'end_date' => 'required|date|after_or_equal:start_date', // Tambah validasi end_date
            'komentar_awal' => 'nullable|string',
        ]);

        // Hitung jumlah minggu
        $startDate = Carbon::parse($validated['start_date']);
        $endDate = Carbon::parse($validated['end_date']);
        $weeks = $startDate->diffInWeeks($endDate) + 1; // Tambah 1 untuk inklusif

        // Simpan ke database
        Project::create(array_merge($validated, ['week' => $weeks]));

        // Redirect kembali ke halaman baseproject
        return redirect()->back()->with('success', 'Proyek berhasil ditambahkan!');
    }

    public function show($id)
{
    $project = \App\Models\Project::findOrFail($id);

    // Tambahkan ini untuk mengambil semua submission dari database
    $submissions = \App\Models\ProjectSubmission::with('user')
        ->where('project_id', $id)
        ->latest()
        ->get();

    return view('admin.detail', compact('project', 'submissions'));
}


// app/Http/Controllers/Admin/ProjectController.php
public function list()
{

     $user = Auth::user(); // ambil user yang sedang login
    // Ambil semua project (opsional untuk bagian bawah dashboard, kalau mau tetap pakai)
    $projects = Project::all();

    // Hitung jumlah berdasarkan skema
    $penelitianCount = Project::where('skema', 'Penelitian')->count();
    $pengabdianCount = Project::where('skema', 'Pengabdian Kepada Masyarakat')->count();

    // Ambil 3 proyek terdekat berdasarkan deadline bulan ini atau setelahnya
    $now = Carbon::now();
    $taskProjects = Project::whereDate('end_date', '>=', $now->startOfMonth())
        ->orderBy('end_date')
        ->limit(3)
        ->get();

    // Jika kurang dari 3, ambil tambahan dari proyek terdekat berikutnya
    if ($taskProjects->count() < 3) {
        $additional = Project::whereDate('end_date', '>', $now)
            ->whereNotIn('id', $taskProjects->pluck('id'))
            ->orderBy('end_date')
            ->limit(3 - $taskProjects->count())
            ->get();

        $taskProjects = $taskProjects->merge($additional);
    }

    return view('admin.index', compact('user', 'projects', 'penelitianCount', 'pengabdianCount', 'taskProjects'));
}

public function submissions($project_id)
{
    $project = Project::findOrFail($project_id);

    // Ambil semua submission yang terkait dengan project ini
    $submissions = ProjectSubmission::with('user')
        ->where('project_id', $project_id)
        ->latest()
        ->get();

    return view('admin.submissions', compact('project', 'submissions'));
}

public function showRequests()
{
    $requests = DB::table('project_requests')
        ->join('users', 'project_requests.user_id', '=', 'users.id')
        ->join('projects', 'project_requests.project_id', '=', 'projects.id')
        ->select('project_requests.*', 'users.name as user_name', 'projects.nama_project')
        ->where('project_requests.status', 'pending')
        ->get();

    return view('admin.project_requests', compact('requests'));
}

public function acceptRequest(Request $request, $id)
{
    DB::table('project_requests')->where('id', $id)->update(['status' => 'accepted']);
    DB::table('project_user')->insert([
        'project_id' => $request->project_id,
        'user_id' => $request->user_id
    ]);
    return back()->with('success', 'Permintaan diterima.');
}

public function rejectRequest($id)
{
    DB::table('project_requests')->where('id', $id)->update(['status' => 'rejected']);
    return back()->with('success', 'Permintaan ditolak.');
}

public function weeklyTasks($id)
{
    $project = Project::with('weeklyTasks')->findOrFail($id);
    $project_user = ProjectUser::with('user')->where('project_id', $id)->get();
    return view('admin.project.weekly_tasks', compact('project', 'project_user'));
}

public function storeWeeklyTask(Request $request, $id)
{
    // dd($request->all());
    $request->validate([
        'week_number' => 'required|integer|min:1',
        'task_descriptions' => 'required|array|min:1',
        'task_descriptions.*' => 'required|string|max:500',
    ]);

    $project = Project::findOrFail($id);

    $projectStart = \Carbon\Carbon::parse($project->start_date);
    $projectEnd   = \Carbon\Carbon::parse($project->end_date);

    $weekNumber = $request->week_number;

    // Hitung tanggal mulai minggu (tetap hitung ke senin)
    $taskStart = $projectStart->copy()->addWeeks($weekNumber - 1)->startOfWeek(\Carbon\Carbon::MONDAY);

    // Hitung tanggal akhir minggu (minggu minggu)
    $taskEnd = $taskStart->copy()->endOfWeek(\Carbon\Carbon::SUNDAY);

    // Jika tanggal mulai < start_date project, pakai projectStart
    if ($taskStart->lt($projectStart)) {
        $taskStart = $projectStart->copy();
    }

    // Jika tanggal akhir > end_date project, pakai projectEnd
    if ($taskEnd->gt($projectEnd)) {
        $taskEnd = $projectEnd->copy();
    }

    foreach ($request->task_descriptions as $desc) {
        ProjectWeeklyTask::create([
            'project_id' => $id,
            'week_number' => $weekNumber,
            'week_start_date' => $taskStart,
            'week_end_date' => $taskEnd,
            'task_description' => $desc,
        ]);
    }

    return redirect()->back()->with('success', 'Semua tugas mingguan berhasil ditambahkan.');
}

public function userTask($id)
{
    // Ambil relasi project_user
    $projectUser = ProjectUser::with('project', 'user')->findOrFail($id);

    $project = $projectUser->project;
    $userId = $projectUser->user_id;

    // Ambil tugas mingguan yang sudah di-assign ke user ini
    $weeklyTasks = ProjectWeeklyTask::where('project_id', $project->id)
        ->where('assigned_to', $userId)
        ->orderBy('week_number')
        ->get();

    // Semua tugas project untuk assign baru
    $allWeeklyTasks = ProjectWeeklyTask::where('project_id', $project->id)
        ->orderBy('week_number')
        ->get();

    return view('admin.project.user_tasks', [
        'project_user' => $projectUser,
        'project' => $project,
        'weeklyTasks' => $weeklyTasks,
        'allWeeklyTasks' => $allWeeklyTasks,
        'user_id' => $userId
    ]);
}

public function assignTask(Request $request)
{
    // dd($request->all());
    
    // Validasi request
    $request->validate([
        'task_id' => 'required|exists:project_weekly_tasks,id',
        'user_id' => 'required|exists:users,id',
    ]);

    // Cari task berdasarkan task_id
    $task = ProjectWeeklyTask::findOrFail($request->task_id);

    // Pastikan field assigned_to masih null sebelum di-assign
    if ($task->assigned_to) {
        return back()->with('error', 'Tugas ini sudah diassign ke user lain.');
    }

    // Update field assigned_to
    $task->assigned_to = $request->user_id;
    $task->save();

    return back()->with('success', 'Tugas berhasil diassign ke user.');
}





}
