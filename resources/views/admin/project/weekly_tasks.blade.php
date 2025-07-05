<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Base Engineering</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg bg-light shadow-sm">
  <div class="container">
    <a class="navbar-brand fw-bold" href="#">Base Engineering Indonesia</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item"><a class="nav-link" href="/admin">Dashboard</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ route('admin.baseproject') }}">Base Project</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ route('admin.activityreport') }}">Activity Report</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ route('admin.project.requests') }}">Request Masuk</a></li>
      </ul>
      <ul class="navbar-nav ms-3">
        <li class="nav-item">
          <a class="nav-link position-relative" href="#">
            <i class="bi bi-bell fs-5"></i>
            <span class="position-absolute top-0 start-100 translate-middle p-1 bg-danger border border-light rounded-circle">
              <span class="visually-hidden">New alerts</span>
            </span>
          </a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown">
            <img src="https://via.placeholder.com/30" class="rounded-circle me-1" width="30" height="30">
          </a>
          <ul class="dropdown-menu dropdown-menu-end">
            <li><a class="dropdown-item" href="#">Edit Profile</a></li>
            <li><a class="dropdown-item" href="#">Change Password</a></li>
            <li><hr class="dropdown-divider"></li>
            <li>
              <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="dropdown-item text-danger">Logout</button>
              </form>
            </li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>

<!-- Content -->
<div class="container mt-4">
  <h4>Daftar Tugas Mingguan: {{ $project->nama_project }}</h4>

  <!-- Form tambah tugas -->
  <div class="card mb-4">
    <div class="card-header">Tambah Tugas Mingguan</div>
    <div class="card-body">
      <form method="POST" action="{{ route('admin.project.weekly.tasks.store', $project->id) }}">
        @csrf
        <div class="mb-3">
          <label for="week_start_date" class="form-label">Minggu Dimulai</label>
          <input type="date" name="week_start_date" id="week_start_date" class="form-control" required>
        </div>

        <div class="mb-3">
          <label class="form-label">Daftar Tugas</label>
          <div id="task-list">
            <div class="input-group mb-2">
              <input type="text" name="task_descriptions[]" class="form-control" placeholder="Tugas 1" required>
              <button type="button" class="btn btn-danger btn-remove-task"><i class="bi bi-x-circle"></i></button>
            </div>
          </div>
          <button type="button" class="btn btn-sm btn-secondary" id="add-task-btn">
            <i class="bi bi-plus-circle"></i> Tambah Baris Tugas
          </button>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Simpan Semua Tugas</button>
      </form>
    </div>
  </div>

  <!-- Tabel tugas yang sudah ada -->
  <div class="card">
    <div class="card-header">Tugas Mingguan Tersimpan</div>
    <div class="card-body table-responsive">
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>#</th>
            <th>Minggu Dimulai</th>
            <th>Deskripsi</th>
            <th>Dibuat</th>
          </tr>
        </thead>
        <tbody>
          @forelse ($project->weeklyTasks as $i => $task)
            <tr>
              <td>{{ $i + 1 }}</td>
              <td>{{ \Carbon\Carbon::parse($task->week_start_date)->translatedFormat('d F Y') }}</td>
              <td>{{ $task->task_description }}</td>
              <td>{{ $task->created_at->diffForHumans() }}</td>
            </tr>
          @empty
            <tr>
              <td colspan="4" class="text-center text-muted">Belum ada tugas mingguan.</td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
  document.addEventListener('DOMContentLoaded', function () {
    const addBtn = document.getElementById('add-task-btn');
    const taskList = document.getElementById('task-list');

    addBtn.addEventListener('click', function () {
      const taskInput = document.createElement('div');
      taskInput.classList.add('input-group', 'mb-2');
      taskInput.innerHTML = `
        <input type="text" name="task_descriptions[]" class="form-control" placeholder="Tugas lainnya" required>
        <button type="button" class="btn btn-danger btn-remove-task"><i class="bi bi-x-circle"></i></button>
      `;
      taskList.appendChild(taskInput);
    });

    taskList.addEventListener('click', function (e) {
      if (e.target.closest('.btn-remove-task')) {
        e.target.closest('.input-group').remove();
      }
    });
  });
</script>
</body>
</html>
