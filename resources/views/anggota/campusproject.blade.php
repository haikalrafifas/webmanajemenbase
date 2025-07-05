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
        <li class="nav-item"><a class="nav-link active" href="/anggota">Dashboard</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ route('anggota.statistics') }}">Statistics</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ route('anggota.baseprojects') }}">Base Project</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ route('anggota.campusproject') }}">Campus Project</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ route('member.activity') }}">My Activity</a></li>
      </ul>

      <ul class="navbar-nav ms-3">
        <!-- Notification -->
        <li class="nav-item">
          <a class="nav-link position-relative" href="#">
            <i class="bi bi-bell fs-5"></i>
            <span class="position-absolute top-0 start-100 translate-middle p-1 bg-danger border border-light rounded-circle">
              <span class="visually-hidden">New alerts</span>
            </span>
          </a>
        </li>

        <!-- Profile Dropdown -->
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" role="button" data-bs-toggle="dropdown">
            <img src="https://via.placeholder.com/30" alt="Profile" class="rounded-circle me-1" width="30" height="30">
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

<!-- Main Content -->
<div class="container mt-5">
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h4>Timeline Tugas Kampus</h4>
    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahTugasModal">
      <i class="bi bi-plus-circle"></i> Tambah Tugas
    </button>
  </div>

  <div class="table-responsive shadow-sm">
    <table class="table table-bordered align-middle">
      <thead class="table-light text-center">
        <tr>
          <th>No</th>
          <th>Mata Kuliah</th>
          <th>Tugas</th>
          <th>Deadline</th>
          <th>Status</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        @forelse($tasks as $index => $task)
          <tr class="text-center">
            <td>{{ $index + 1 }}</td>
            <td>{{ $task->mata_kuliah }}</td>
            <td>{{ $task->tugas }}</td>
            <td>{{ \Carbon\Carbon::parse($task->deadline)->format('d M Y') }}</td>
            <td>
              @if($task->status === 'On-going')
                <span class="badge bg-warning text-dark">On-going</span>
              @else
                <span class="badge bg-success">Done</span>
              @endif
            </td>
            <td>
              <form action="{{ route('anggota.campus-tasks.toggle-status', $task->id) }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-sm btn-outline-secondary" title="Ubah Status">
                  <i class="bi bi-arrow-repeat"></i>
                </button>
              </form>
            </td>
          </tr>
        @empty
          <tr>
            <td colspan="6" class="text-center text-muted">Belum ada tugas kampus.</td>
          </tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>

<!-- Modal Tambah Tugas -->
<div class="modal fade" id="tambahTugasModal" tabindex="-1" aria-labelledby="tambahTugasModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form action="{{ route('anggota.campus-tasks.store') }}" method="POST" class="modal-content">
      @csrf
      <div class="modal-header">
        <h5 class="modal-title">Tambah Tugas Baru</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <div class="mb-3">
          <label class="form-label">Mata Kuliah</label>
          <input type="text" class="form-control" name="mata_kuliah" required>
        </div>
        <div class="mb-3">
          <label class="form-label">Tugas</label>
          <input type="text" class="form-control" name="tugas" required>
        </div>
        <div class="mb-3">
          <label class="form-label">Deadline</label>
          <input type="date" class="form-control" name="deadline" required>
        </div>
        <div class="mb-3">
          <label class="form-label">Status</label>
          <select class="form-select" name="status" required>
            <option value="On-going" selected>On-going</option>
            <option value="Done">Done</option>
          </select>
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-success">
          <i class="bi bi-check-circle"></i> Simpan
        </button>
      </div>
    </form>
  </div>
</div>

<!-- Bootstrap Script -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
