<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Anggota\CampusController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\TechnologyBriefController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\Admin\BaseProjectController;
use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\MyActivityController;
use App\Http\Controllers\ProjectsController;
use App\Http\Controllers\Admin\AdminStatisticsController;


// Halaman utama (bisa diakses siapa saja)
Route::get('/', [HomeController::class, 'index']);

// Halaman publik lainnya
Route::get('/projects', [ProjectsController::class, 'index'])->name('projects.index');

Route::get('/technologybrief', [TechnologyBriefController::class, 'index'])->name('technologybrief.index');

// Auth routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

// Hanya user yang sudah login yang bisa akses route di bawah
Route::middleware('auth')->group(function () {

    // Admin Dashboard
    Route::get('/admin', function () {
        return view('admin.index');
    })->name('admin.index');
    
    Route::get('/baseproject', [BaseProjectController::class, 'index'])->name('admin.baseproject');
    Route::get('/detail', function () {
        return view('admin.detail');
    })->name('admin.detail');

    Route::post('/admin/projects/store', [ProjectController::class, 'store'])->name('admin.projects.store');

    Route::get('/detail/{id}', [ProjectController::class, 'show'])->name('admin.detail');

    // routes/web.php
Route::get('/admin', [ProjectController::class, 'list'])->name('admin.index');

// routes/web.php
Route::post('/admin/submit/review/{id}', [ProjectController::class, 'reviewSubmission'])->name('admin.submit.review');


Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/activity-report', [MyActivityController::class, 'adminReportView'])->name('admin.activityreport');
});


Route::post('/admin/activity-report/update', [MyActivityController::class, 'updateScores'])->name('admin.activityreport.update');

Route::get('/admin/project/{id}/weekly-tasks', [ProjectController::class, 'weeklyTasks'])->name('admin.project.weekly.tasks');
Route::post('/admin/project/{id}/weekly-tasks', [ProjectController::class, 'storeWeeklyTask'])->name('admin.project.weekly.tasks.store');
Route::get('/admin/project/{id}/weekly-tasks/user_task', [ProjectController::class, 'userTask'])->name('admin.project.weekly.tasks.user_task');
Route::post('/assign-task', [ProjectController::class, 'assignTask'])->name('assign.task');

// Admin routes
Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/project-requests', [\App\Http\Controllers\Admin\ProjectController::class, 'showRequests'])->name('admin.project.requests');
    Route::post('/project-requests/{id}/accept', [\App\Http\Controllers\Admin\ProjectController::class, 'acceptRequest'])->name('admin.project.request.accept');
    Route::post('/project-requests/{id}/reject', [\App\Http\Controllers\Admin\ProjectController::class, 'rejectRequest'])->name('admin.project.request.reject');
});



Route::get('/admin/statistics', [AdminStatisticsController::class, 'index'])->name('admin.statistics');


// Anggota Base Dashboard
Route::get('/anggota', [AnggotaController::class, 'index'])->name('anggota.index');
// Route::get('/statistics', [AnggotaController::class, 'statistics'])->name('anggota.statistics');
Route::get('/baseprojects', [AnggotaController::class, 'baseprojects'])->name('anggota.baseprojects');
Route::get('/campusproject', [AnggotaController::class, 'campusproject'])->name('anggota.campusproject');
Route::get('/anggota/detail/{id}', [AnggotaController::class, 'detail'])->name('anggota.project.detail');



Route::middleware(['auth'])->prefix('anggota')->group(function () {

    Route::get('/my-activity', [MyActivityController::class, 'index'])->name('member.activity');
    Route::post('/my-activity', [MyActivityController::class, 'store'])->name('member.activity.store');
});


   Route::post('/anggota/campus-tasks', [AnggotaController::class, 'storeCampusTask'])->name('anggota.campus-tasks.store');
});

Route::get('/anggota/base-projects', [AnggotaController::class, 'baseProjects'])->name('anggota.baseprojects');

Route::post('/anggota/submit-project/{id}', [AnggotaController::class, 'submitProject'])->name('anggota.submit.project');

Route::get('/anggota', [AnggotaController::class, 'index'])->name('anggota.index');
Route::post('/anggota/campus-tasks/{id}/toggle-status', [AnggotaController::class, 'toggleCampusTaskStatus'])->name('anggota.campus-tasks.toggle-status');

Route::post('/anggota/project/{id}/request', [AnggotaController::class, 'requestJoinProject'])
     ->name('anggota.project.request');

Route::get('/anggota/project/{id}/weekly-tasks', [AnggotaController::class, 'showWeeklyTasks'])->name('anggota.weekly.tasks');
Route::post('/anggota/weekly-tasks/{task_id}/submit', [AnggotaController::class, 'submitWeeklyTask'])->name('anggota.weekly.tasks.submit');
Route::get('/anggota/project/{id}/user-tasks', [AnggotaController::class, 'showUserTasks'])->name('anggota.user.tasks');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
