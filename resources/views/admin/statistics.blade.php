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
@include('admin.partials.navbar')

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
