<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Permintaan Join Proyek - Admin</title>
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
        <li class="nav-item"><a class="nav-link active" href="{{ route('admin.project.requests') }}">Request Masuk</a></li>
      </ul>
      <ul class="navbar-nav ms-3">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" role="button" data-bs-toggle="dropdown">
            <img src="https://via.placeholder.com/30" alt="Profile" class="rounded-circle me-1">
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
  <h4 class="mb-4">Permintaan Join Proyek</h4>

  <div class="table-responsive">
    <table class="table table-bordered align-middle">
      <thead class="table-light text-center">
        <tr>
          <th>No</th>
          <th>Nama Anggota</th>
          <th>Project</th>
          <th>Tanggal Request</th>
          <th>Status</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        @forelse ($requests as $index => $request)
        <tr class="text-center">
          <td>{{ $index + 1 }}</td>
          <td>{{ $request->user_name }}</td>
          <td>{{ $request->nama_project }}</td>
          <td>{{ \Carbon\Carbon::parse($request->created_at)->translatedFormat('d F Y H:i') }}</td>
          <td>
            <span class="badge bg-warning text-dark">{{ ucfirst($request->status) }}</span>
          </td>
          <td>
            <form action="{{ route('admin.project.request.accept', $request->id) }}" method="POST" class="d-inline">
              @csrf
              <button class="btn btn-sm btn-success">Terima</button>
            </form>
            <form action="{{ route('admin.project.request.reject', $request->id) }}" method="POST" class="d-inline">
              @csrf
              <button class="btn btn-sm btn-danger">Tolak</button>
            </form>
          </td>
        </tr>
        @empty
        <tr>
          <td colspan="6" class="text-center text-muted">Belum ada permintaan masuk.</td>
        </tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
