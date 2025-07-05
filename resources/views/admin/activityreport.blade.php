<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Activity Report - Admin</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
</head>
<body>

@php
    use Illuminate\Support\Str;
@endphp

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

<!-- Main Content -->
<div class="container mt-5">
  <h3 class="mb-4">Activity Report</h3>

  <form method="POST" action="{{ route('admin.activityreport.update') }}">
    @csrf
    <div class="table-responsive">
      <table class="table table-bordered align-middle text-center">
        <thead class="table-light">
          <tr>
            <th>Nama</th>
            @foreach ($weeks as $week)
              <th>Minggu {{ \Carbon\Carbon::parse($week)->format('W') }}</th>
            @endforeach
          </tr>
        </thead>
        <tbody>
          @foreach ($users as $user)
            <tr>
              <td class="text-start">{{ $user->name }}</td>
              @foreach ($weeks as $week)
                @php
                  $activity = $reports[$user->id]->firstWhere('week_start_date', $week) ?? null;
                  $scoreValue = $activity->score ?? '';
                  $content = $activity->content ?? '';
                  $hasScore = $scoreValue !== null && $scoreValue !== '';
                  $inputClass = $hasScore ? 'bg-success text-white fw-bold' : '';
                @endphp
                <td>
                  <input type="hidden" name="entries[{{ $user->id }}][{{ $week }}][activity_id]" value="{{ $activity->id ?? '' }}">
                  <input type="number" class="form-control form-control-sm mb-1 {{ $inputClass }}"
                         name="entries[{{ $user->id }}][{{ $week }}][score]"
                         value="{{ $scoreValue }}"
                         placeholder="Nilai">

                  @if ($content)
                    <a href="#" class="text-decoration-none text-info small"
                       data-bs-toggle="modal"
                       data-bs-target="#modal-{{ $user->id }}-{{ $loop->parent->index }}">
                      {{ Str::limit($content, 30) }}
                    </a>
                  @else
                    <span class="text-muted small">Tidak ada laporan</span>
                  @endif
                </td>
              @endforeach
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>

    <div class="text-end">
      <button type="submit" class="btn btn-primary">Simpan Nilai</button>
    </div>
  </form>

  <!-- Modal Section -->
  @foreach ($users as $user)
    @foreach ($weeks as $week)
      @php
        $activity = $reports[$user->id]->firstWhere('week_start_date', $week) ?? null;
        $content = $activity->content ?? null;
      @endphp

      @if ($content)
        <div class="modal fade" id="modal-{{ $user->id }}-{{ $loop->parent->index }}" tabindex="-1"
             aria-labelledby="modalLabel-{{ $user->id }}-{{ $loop->parent->index }}" aria-hidden="true">
          <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="modalLabel-{{ $user->id }}-{{ $loop->parent->index }}">
                  Laporan: {{ $user->name }} - Minggu {{ \Carbon\Carbon::parse($week)->format('W') }}
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
              </div>
              <div class="modal-body">
                <p>{{ $content }}</p>
              </div>
            </div>
          </div>
        </div>
      @endif
    @endforeach
  @endforeach
</div>

<!-- Bootstrap JS (pastikan di akhir body) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
