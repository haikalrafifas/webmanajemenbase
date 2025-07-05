<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Base Engineering</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
            <img src="https://via.placeholder.com/30" alt="Profile" class="rounded-circle me-1" width="30" height="30">
          </a>
          <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
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

<!-- Leaderboard Section -->
<div class="container mt-5">
  
  <!-- Leaderboard Minggu Ini -->
  <div class="card mt-4 shadow-sm">
    <div class="card-body">
      <h5 class="card-title mb-3">🏅 Leaderboard Minggu Ini</h5>
      @include('anggota.partials.leaderboard-table', ['leaderboard' => $leaderboardThisWeek])
    </div>
  </div>

  <!-- Leaderboard Bulan Ini -->
  <div class="card mt-4 shadow-sm">
    <div class="card-body">
      <h5 class="card-title mb-3">📅 Leaderboard Bulan Ini</h5>
      @include('anggota.partials.leaderboard-table', ['leaderboard' => $leaderboardThisMonth])
    </div>
  </div>

  <!-- Leaderboard Sepanjang Masa -->
  <div class="card mt-4 shadow-sm mb-5">
    <div class="card-body">
      <h5 class="card-title mb-3">🏆 Leaderboard Sepanjang Masa</h5>
      @include('anggota.partials.leaderboard-table', ['leaderboard' => $leaderboardAllTime])
    </div>
  </div>

</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
