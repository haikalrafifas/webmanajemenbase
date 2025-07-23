<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Project;
use App\Models\ProjectSubmission;
use App\Models\ProjectWeeklyTask;
use Carbon\Carbon;



class ProjectController extends Controller
{
    public function store(Request $request)
    {
        // Validasi
        $validated = $request->validate([
            'nama_project' => 'required|string|max:255',
            'pic' => 'required|string|max:255',
            'fokus' => 'nullable|string|max:255',
            'skema' => 'nullable|string|max:100',
            'tahun' => 'nullable|integer',
            'deadline' => 'nullable|date',
            'komentar_awal' => 'nullable|string',
        ]);

        // Simpan ke database
        Project::create($validated);

        // Redirect kembali ke halaman baseproject (atau sesuaikan)
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
    $taskProjects = Project::whereDate('deadline', '>=', $now->startOfMonth())
        ->orderBy('deadline')
        ->limit(3)
        ->get();

    // Jika kurang dari 3, ambil tambahan dari proyek terdekat berikutnya
    if ($taskProjects->count() < 3) {
        $additional = Project::whereDate('deadline', '>', $now)
            ->whereNotIn('id', $taskProjects->pluck('id'))
            ->orderBy('deadline')
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
    return view('admin.project.weekly_tasks', compact('project'));
}

public function storeWeeklyTask(Request $request, $id)
{
    $request->validate([
        'week_start_date' => 'required|date',
        'task_descriptions' => 'required|array|min:1',
        'task_descriptions.*' => 'required|string|max:500',
    ]);

    foreach ($request->task_descriptions as $desc) {
        ProjectWeeklyTask::create([
            'project_id' => $id,
            'week_start_date' => $request->week_start_date,
            'task_description' => $desc,
        ]);
    }

    return redirect()->back()->with('success', 'Semua tugas mingguan berhasil ditambahkan.');
}





}
