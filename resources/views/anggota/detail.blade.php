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
@include('anggota.partials.navbar')

<!-- Konten Detail Proyek -->
<div class="container mt-5">
  <h4 class="mb-4 fw-bold">Detail Proyek</h4>

  <div class="row">
  <div class="col-md-6">
    <ul class="list-unstyled">
      <li><strong>Nama Project:</strong> {{ $project->nama_project }}</li>
      <li><strong>PIC:</strong> {{ $project->pic }}</li>
      <li><strong>Fokus:</strong> {{ $project->fokus }}</li>
      <li><strong>Skema:</strong> {{ $project->skema }}</li>
      <li><strong>Tahun Pelaksanaan:</strong> {{ $project->tahun }}</li>
      <li><strong>Deadline:</strong> {{ $project->deadline ?? '-' }}</li>
      <li><strong>Output:</strong> {{ $project->output ?? '-' }}</li>
      <li><strong>Status:</strong> 
        @if ($project->status == 'Belum Dimulai')
          <span class="badge bg-warning text-dark">Belum Dimulai</span>
        @elseif ($project->status == 'Sedang Berjalan')
          <span class="badge bg-primary">Sedang Berjalan</span>
        @elseif ($project->status == 'Selesai')
          <span class="badge bg-success">Selesai</span>
        @else
          <span class="badge bg-secondary">-</span>
        @endif
      </li>
    </ul>
  </div>



<!-- Tabel Pengumpulan Tugas -->
<div class="container mt-5">
  <h4 class="mb-3">Daftar Tugas Proyek</h4>
  <div class="table-responsive">
    <table class="table table-bordered align-middle">
      <thead class="table-light text-center">
        <tr>
          <th>No</th>
          <th>PIC</th>
          <th>Prodi</th>
          <th>Tugas</th>
          <th>Deadline</th>
          <th>Submit</th>
          <th>Status</th>
        </tr>
      </thead>
      <tbody>
        <!-- Contoh Data Dummy -->
        <tr class="text-center">
          <td>1</td>
          <td>Ivan Setiawan</td>
          <td>Sistem Informasi</td>
          <td>Laporan Tengah Semester</td>
          <td>20 Juni 2025</td>
          <td>
            <button class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#submitModal">
              <i class="bi bi-upload"></i> Submit
            </button>
          </td>
          <td><span class="badge bg-warning text-dark">Belum Dikirim</span></td>
        </tr>
      </tbody>
    </table>
  </div>
</div>

<!-- Modal Submit -->
<div class="modal fade" id="submitModal" tabindex="-1" aria-labelledby="submitModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <form action="{{ route('anggota.submit.project', $project->id) }}" method="POST" enctype="multipart/form-data" class="modal-content">
    @csrf
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
