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

<!-- Main Content -->
<div class="container mt-5">
  <h4 class="mb-4">Kelola Proyek Anggota</h4>

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
          <th>Komentar Anda</th>
          <th>Aksi</th>
          <th>Tugas</th>
        </tr>
      </thead>
      <tbody>
  @forelse ($projects as $index => $project)
  <tr class="text-center">
    <td>{{ $index + 1 }}</td>
    <td class="text-start">{{ $project->nama_project }}</td>
    <td>{{ $project->pic }}</td>
    <td>{{ $project->fokus }}</td>
    <td>{{ $project->skema }}</td>
    <td>{{ $project->tahun }}</td>
    <td class="text-start">
      <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#adminKomentarModal{{ $project->id }}">
        <i class="bi bi-chat-dots"></i> Komentar
      </button>
    </td>
    <td>
      <a href="{{ route('admin.detail', $project->id) }}" class="btn btn-sm btn-outline-info">
        <i class="bi bi-eye"></i> Lihat
      </a>
    </td>
    <td>
  <a href="{{ route('admin.project.weekly.tasks', $project->id) }}" class="btn btn-sm btn-outline-success">
  <i class="bi bi-list-task"></i> Tugas
</a>
</td>

  </tr>

  <!-- Modal Komentar (optional, bisa dikembangkan untuk tiap proyek) -->
  <div class="modal fade" id="adminKomentarModal{{ $project->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Komentar untuk {{ $project->nama_project }}</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <textarea class="form-control" rows="4" placeholder="Tulis komentar..."></textarea>
        </div>
        <div class="modal-footer">
          <button class="btn btn-primary">Simpan Komentar</button>
        </div>
      </div>
    </div>
  </div>
  @empty
  <tr>
    <td colspan="8" class="text-center">Belum ada data proyek.</td>
  </tr>
  @endforelse
</tbody>

    </table>
  </div>

  <!-- Tombol Tambah Proyek (di bawah kanan tabel, tidak floating) -->
  <div class="d-flex justify-content-end mt-3 pe-4">
    <button class="btn btn-success rounded-circle shadow"
            style="width: 50px; height: 50px;"
            data-bs-toggle="modal" data-bs-target="#modalTambahProyek"
            title="Tambah Proyek">
      <i class="bi bi-plus-lg fs-4"></i>
    </button>
  </div>
</div>

<!-- Modal Tambah Proyek -->
<div class="modal fade" id="modalTambahProyek" tabindex="-1" aria-labelledby="modalTambahProyekLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <form action="{{ route('admin.projects.store') }}" method="POST" class="modal-content">
  @csrf
  <div class="modal-header">
    <h5 class="modal-title" id="modalTambahProyekLabel">Tambah Proyek Baru</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
  </div>
  <div class="modal-body">
        <div class="row g-3">
          <div class="col-md-6">
            <label for="namaProject" class="form-label">Nama Project</label>
            <input type="text" class="form-control" id="namaProject" name="nama_project" required>
          </div>
          <div class="col-md-6">
            <label for="pic" class="form-label">PIC</label>
            <input type="text" class="form-control" id="pic" name="pic" required>
          </div>
          <div class="col-md-6">
            <label for="fokus" class="form-label">Fokus</label>
            <input type="text" class="form-control" id="fokus" name="fokus">
          </div>
          <div class="col-md-6">
            <label for="skema" class="form-label">Skema</label>
            <select class="form-select" id="skema" name="skema">
              <option value="Penelitian">Penelitian</option>
              <option value="Pengabdian Kepada Masyarakat">Pengabdian Kepada Masyarakat</option>
              <option value="Lainnya">Lainnya</option>
            </select>
          </div>
          <div class="col-md-6">
            <label for="deadline" class="form-label">Deadline</label>
            <input type="date" class="form-control" id="deadline" name="deadline">
          </div>
          <div class="col-md-6">
            <label for="tahun" class="form-label">Tahun</label>
            <input type="number" class="form-control" id="tahun" name="tahun" value="2025">
          </div>
          <div class="col-12">
            <label for="komentarAwal" class="form-label">Komentar Awal</label>
            <textarea class="form-control" id="komentarAwal" name="komentar_awal" rows="3"></textarea>
          </div>
        </div>
      </div>
 <div class="modal-footer">
    <button type="submit" class="btn btn-primary">
      <i class="bi bi-save"></i> Simpan Proyek
    </button>
  </div>
    </form>
  </div>
</div>

<script>
  document.addEventListener("DOMContentLoaded", function () {
    const deadlineInput = document.getElementById("deadline");
    const tahunInput = document.getElementById("tahun");

    function updateDeadlineConstraints() {
      const today = new Date().toISOString().split("T")[0];
      deadlineInput.setAttribute("min", today);

      const selectedYear = parseInt(tahunInput.value) || new Date().getFullYear();
      const maxDate = new Date(selectedYear, 11, 31).toISOString().split("T")[0];
      deadlineInput.setAttribute("max", maxDate);
    }

    // Jalankan saat halaman pertama kali dimuat
    updateDeadlineConstraints();

    // Jalankan lagi saat input tahun diubah
    tahunInput.addEventListener("input", updateDeadlineConstraints);
  });
</script>



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
