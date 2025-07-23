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
@include('anggota.partials.navbar')

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
