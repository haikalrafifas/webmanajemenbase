<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
<meta http-equiv="Pragma" content="no-cache" />
<meta http-equiv="Expires" content="0" />

  <title>My Weekly Activity</title>
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
        <li class="nav-item"><a class="nav-link" href="/anggota">Dashboard</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ route('anggota.statistics') }}">Statistics</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ route('anggota.baseprojects') }}">Base Project</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ route('anggota.campusproject') }}">Campus Project</a></li>
        <li class="nav-item"><a class="nav-link active" href="{{ route('member.activity') }}">My Activity</a></li>
      </ul>

      <ul class="navbar-nav ms-3">
        <li class="nav-item">
          <a class="nav-link position-relative" href="#"><i class="bi bi-bell fs-5"></i></a>
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

<!-- Main Content -->
<div class="container mt-5">
  <h3 class="mb-3">My Weekly Activity</h3>

  <div class="card">
    <div class="card-header bg-primary text-white">
      Periode: {{ \Carbon\Carbon::now()->startOfWeek()->format('d M Y') }} - {{ \Carbon\Carbon::now()->endOfWeek()->format('d M Y') }}
    </div>

    <div class="card-body">
      @if($activity && $activity->content)
        <p><strong>Aktivitas Anda:</strong></p>
        <div class="p-3 border bg-light mb-3 rounded">
          {{ $activity->content }}
        </div>

        @if($activity->score !== null)
          <div class="alert alert-success">
            ✅ Nilai Anda minggu ini: <strong>{{ $activity->score }}</strong>
          </div>
        @else
          <div class="alert alert-warning">
            ⏳ Menunggu penilaian dari admin.
          </div>
        @endif

      @else
        <form method="POST" action="{{ route('member.activity.store') }}">
          @csrf
          <div class="mb-3">
            <label for="content" class="form-label">Aktivitas Mingguan</label>
            <textarea class="form-control" id="content" name="content" rows="5" required>{{ $activity->content ?? '' }}</textarea>
          </div>
          <button type="submit" class="btn btn-primary">Simpan Aktivitas</button>
        </form>
      @endif

      @if(session('success'))
        <div class="alert alert-success mt-3">{{ session('success') }}</div>
      @endif
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
