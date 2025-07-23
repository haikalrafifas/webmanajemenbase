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
@include('admin.partials.navbar')

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
  <div class="card mb-4">
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

  {{-- Tabel User Projek --}}
  <div class="card">
    <div class="card-header">Anggota Projek</div>
    <div class="card-body table-responsive">
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>#</th>
            <th>Nama</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          @forelse ($project_user as $i => $project)
            <tr>
              <td>{{ $i + 1 }}</td>
              <td>{{ $project->user->name }}</td>
              <td>
                <a href="#" class="btn btn-sm btn-primary">Tugas</a>
              </td>
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
