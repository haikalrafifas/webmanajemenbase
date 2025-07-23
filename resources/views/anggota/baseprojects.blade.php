<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Base Projects - Base Engineering</title>
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
        <li class="nav-item"><a class="nav-link" href="/anggota">Dashboard</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ route('anggota.statistics') }}">Statistics</a></li>
        <li class="nav-item"><a class="nav-link active" href="{{ route('anggota.baseprojects') }}">Base Project</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ route('anggota.campusproject') }}">Campus Project</a></li>
             <li class="nav-item"><a class="nav-link" href="{{ route('member.activity') }}">My Activity</a></li>
      </ul>

      <!-- Notifikasi & Profil -->
      <ul class="navbar-nav ms-3">
        <!-- Icon Notifikasi -->
        <li class="nav-item">
          <a class="nav-link position-relative" href="#">
            <i class="bi bi-bell fs-5"></i>
            <span class="position-absolute top-0 start-100 translate-middle p-1 bg-danger border border-light rounded-circle">
              <span class="visually-hidden">New alerts</span>
            </span>
          </a>
        </li>

        <!-- Dropdown Profil -->
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
      <button type="submit" class="dropdown-item text-danger">
        Logout
      </button>
    </form>
  </li>
</ul>
    </div>
  </div>
</nav>

<!-- Content -->
<div class="container mt-5">

  @php
    $requestedProjects = $projects->filter(fn($p) => in_array($p->requested, ['pending', 'accepted']));
    $availableProjects = $projects->filter(fn($p) => $p->requested === null);
  @endphp

  <!-- Tabel: Proyek yang Sudah Didaftar -->
  <h4 class="mb-3">Proyek yang Sudah Didaftar</h4>
  <div class="table-responsive mb-5">
    <table class="table table-bordered align-middle">
      <thead class="table-light text-center">
        <tr>
          <th>No</th>
          <th>Nama Project</th>
          <th>PIC</th>
          <th>Fokus</th>
          <th>Skema</th>
          <th>Tahun</th>
          <th>Komentar Admin</th>
          <th>Status</th>
          <th>Detail</th>
        </tr>
      </thead>
      <tbody>
        @forelse ($requestedProjects as $index => $project)
          <tr class="text-center">
            <td>{{ $index + 1 }}</td>
            <td class="text-start">{{ $project->nama_project }}</td>
            <td>{{ $project->pic }}</td>
            <td>{{ $project->fokus }}</td>
            <td>{{ $project->skema }}</td>
            <td>{{ $project->tahun }}</td>
            <td class="text-start">
              <button class="btn btn-sm btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#komentarModal{{ $project->id }}">
                Lihat Komentar
              </button>
            </td>
            <td>
              @if ($project->requested === 'pending')
                <span class="badge bg-secondary">Menunggu</span>
              @else
                <button class="btn btn-sm btn-success">Sudah Bergabung</button>
              @endif
            </td>
            <td>
              <a href="{{ route('anggota.project.detail', $project->id) }}" class="btn btn-sm btn-outline-info">
                <i class="bi bi-eye"></i> Detail
              </a>
            </td>
          </tr>
        @empty
          <tr>
            <td colspan="8" class="text-center text-muted">Belum ada proyek yang Anda daftarkan.</td>
          </tr>
        @endforelse
      </tbody>
    </table>
  </div>

  <!-- Tabel: Proyek yang Masih Tersedia -->
  <h4 class="mb-3">Proyek yang Tersedia</h4>
  <div class="table-responsive">
    <table class="table table-bordered align-middle">
      <thead class="table-light text-center">
        <tr>
          <th>No</th>
          <th>Nama Project</th>
          <th>PIC</th>
          <th>Fokus</th>
          <th>Skema</th>
          <th>Tahun</th>
          <th>Komentar Admin</th>
          <th>Request Join</th>
          <th>Detail</th>
        </tr>
      </thead>
      <tbody>
        @forelse ($availableProjects as $index => $project)
          <tr class="text-center">
            <td>{{ $index + 1 }}</td>
            <td class="text-start">{{ $project->nama_project }}</td>
            <td>{{ $project->pic }}</td>
            <td>{{ $project->fokus }}</td>
            <td>{{ $project->skema }}</td>
            <td>{{ $project->tahun }}</td>
            <td class="text-start">
              <button class="btn btn-sm btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#komentarModal{{ $project->id }}">
                Lihat Komentar
              </button>
            </td>
            <td>
              <form action="{{ route('anggota.project.request', $project->id) }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-sm btn-primary">
                  <i class="bi bi-person-plus"></i> Request Join
                </button>
              </form>
            </td>
            <td>
              <a href="{{ route('anggota.project.detail', $project->id) }}" class="btn btn-sm btn-outline-info">
                <i class="bi bi-eye"></i> Detail
              </a>
            </td>
          </tr>
        @empty
          <tr>
            <td colspan="9" class="text-center text-muted">Tidak ada proyek yang tersedia.</td>
          </tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>

@foreach ($projects as $project)
<div class="modal fade" id="komentarModal{{ $project->id }}" tabindex="-1" aria-labelledby="komentarModalLabel{{ $project->id }}" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="komentarModalLabel{{ $project->id }}">Komentar Admin</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <p><strong>Admin:</strong> {{ $project->komentar_awal ?? 'Belum ada komentar.' }}</p>

        <p><strong>Deadline:</strong> {{ \Carbon\Carbon::parse($project->deadline)->translatedFormat('d F Y') }}</p>
        <p><strong>Status:</strong> <span class="badge bg-{{ $project->status == 'selesai' ? 'success' : 'warning' }}">
          {{ ucfirst($project->status) }}
        </span></p>

        <div class="mb-3">
          <label for="balasan{{ $project->id }}" class="form-label">Balas ke Admin</label>
          <textarea class="form-control" id="balasan{{ $project->id }}" rows="3" placeholder="Tulis balasan..."></textarea>
        </div>
        <button class="btn btn-primary">Kirim</button>
      </div>
    </div>
  </div>
</div>
@endforeach


<!-- Modal Submit -->
<div class="modal fade" id="submitModal" tabindex="-1" aria-labelledby="submitModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <form action="#" method="POST" enctype="multipart/form-data" class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="submitModalLabel">Submit Tugas</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <div class="mb-3">
          <label for="uraian" class="form-label">Uraian</label>
          <textarea class="form-control" id="uraian" name="uraian" rows="4" placeholder="Tuliskan penjelasan tugas..."></textarea>
        </div>
        <div class="mb-3">
          <label for="files" class="form-label">Unggah File (boleh lebih dari 1)</label>
          <input class="form-control" type="file" name="files[]" id="files" multiple accept=".pdf,.doc,.docx">
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">
          <i class="bi bi-send"></i> Kirim Tugas
        </button>
      </div>
    </form>
  </div>
</div>




<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
