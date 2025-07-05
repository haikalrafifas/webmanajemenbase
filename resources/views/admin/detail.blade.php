<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Base Projects - Admin View</title>
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

<!-- DETAIL PROYEK -->
<div class="container my-4">
  <!-- Informasi Utama Proyek -->
  <h4 class="mb-3">Detail Proyek</h4>
  <table class="table table-borderless">
    <tbody>
      <tr>
        <th scope="row" style="width: 20%;">Nama Project</th>
        <td>{{ $project->nama_project }}</td>
      </tr>
      <tr>
        <th scope="row">PIC</th>
        <td>{{ $project->pic }}</td>
      </tr>
      <tr>
        <th scope="row">Fokus</th>
        <td>{{ $project->fokus }}</td>
      </tr>
      <tr>
        <th scope="row">Skema</th>
        <td>{{ $project->skema }}</td>
      </tr>
      <tr>
        <th scope="row">Tahun Pelaksanaan</th>
        <td>{{ $project->tahun }}</td>
      </tr>
      <tr>
        <th scope="row">Deadline</th>
        <td>{{ $project->deadline }}</td>
      </tr>
      <tr>
        <th scope="row">Output</th>
        <td>{{ $project->output }}</td>
      </tr>
      <tr>
        <th scope="row">Status</th>
        <td>
          @if($project->status == 'Berjalan')
            <span class="badge bg-success">Berjalan</span>
          @elseif($project->status == 'Selesai')
            <span class="badge bg-secondary">Selesai</span>
          @else
            <span class="badge bg-warning text-dark">Belum Dimulai</span>
          @endif
        </td>
      </tr>
    </tbody>
  </table>
  <!-- Tabel Anggota/Penanggung Jawab -->
<div class="mt-5">
  <h5 class="mb-3">Penanggung Jawab / Anggota</h5>
  <table class="table table-bordered table-striped">
    <thead class="table-info">
      <tr>
        <th>No</th>
        <th>Nama</th>
        <th>Prodi</th>
        <th>Tugas</th>
        <th>Deadline</th>
        <th>Submit</th>
        <th>Status</th>
      </tr>
    </thead>
 <tbody>
@foreach($submissions as $i => $sub)
<tr>
  <td>{{ $i + 1 }}</td>
  <td>{{ $sub->user->name }}</td>
  <td>{{ $sub->user->prodi ?? '-' }}</td>
  <td>{{ Str::limit($sub->uraian, 100) }}</td>
  <td>{{ $project->deadline }}</td>
  <td>
    <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#modal-{{ $sub->id }}">
      <i class="bi bi-eye"></i> Lihat Submit
    </button>
  </td>
  <td>
    <span class="badge bg-warning">Belum Dinilai</span>
  </td>
</tr>
@endforeach
</tbody>

  </table>
</div>

@foreach($submissions as $sub)
<div class="modal fade" id="modal-{{ $sub->id }}" tabindex="-1" aria-labelledby="modalLabel{{ $sub->id }}" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form method="POST" action="#"> {{-- Tambahkan action kalau ingin update status --}}
        @csrf
        <div class="modal-header">
          <h5 class="modal-title" id="modalLabel{{ $sub->id }}">Detail Submit dari {{ $sub->user->name }}</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <p><strong>Uraian Anggota:</strong></p>
          <p>{{ $sub->uraian }}</p>

          <p><strong>File Laporan:</strong></p>
          @foreach($sub->files as $file)
            <a href="{{ asset('uploads/' . $file) }}" target="_blank" class="btn btn-sm btn-outline-secondary my-1">
              <i class="bi bi-file-earmark-text"></i> {{ $file }}
            </a><br>
          @endforeach

          <div class="mb-3 mt-3">
            <label for="status-{{ $sub->id }}" class="form-label">Status Persetujuan</label>
            <select class="form-select" id="status-{{ $sub->id }}" name="status">
              <option value="menyetujui">Menyetujui</option>
              <option value="tidak_menyetujui">Tidak Menyetujui</option>
            </select>
          </div>

          <div class="mb-3">
            <label for="komentar-{{ $sub->id }}" class="form-label">Komentar Admin</label>
            <textarea class="form-control" id="komentar-{{ $sub->id }}" name="komentar" rows="3"></textarea>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Simpan</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endforeach


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
