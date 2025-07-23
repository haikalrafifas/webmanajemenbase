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

@include('admin.partials.navbar')

<!-- Main Content -->
<div class="container mt-4">

  <!-- Profile Section -->
  <div class="mb-5">
    <h4>Profile</h4>
    <div class="row g-3">
      <div class="col-md-4">
        <div class="card h-100">
          <div class="card-body">
            <h6 class="text-muted">Identitas</h6>
            <h4>{{ $user->name }} ⭐</h4>
            <p class="mb-0">{{ $user->identitas ?? 'Mahasiswa / Anggota Base' }}</p>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card h-100 bg-light">
          <div class="card-body text-center">
            <h6>PENELITIAN</h6>
            <p>Total: {{ $penelitianCount }}</p>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card h-100 bg-light">
          <div class="card-body text-center">
            <h6>PENGABDIAN KEPADA MASYARAKAT</h6>
            <p>Total: {{ $pengabdianCount }}</p>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Tasks Section -->
  <div class="mb-5">
    <h4>Tasks <small class="text-muted">(Upcoming)</small></h4>
    <div class="d-flex justify-content-between align-items-center">
      @forelse ($taskProjects as $task)
        <div class="text-center">
          <i class="bi bi-check-circle-fill text-primary"></i>
          <div>
            {{ $task->nama_project }}<br>
            <small class="text-muted">Deadline: {{ \Carbon\Carbon::parse($task->deadline)->format('d M Y') }}</small>
          </div>
        </div>
        @if (!$loop->last)
          <hr class="flex-grow-1 mx-3">
        @endif
      @empty
        <div class="text-muted">Tidak ada proyek mendekati deadline.</div>
      @endforelse
    </div>
  </div>

  <!-- Project Detail Table -->
  <div class="mb-5">
    <h4>Project Detail List</h4>
    <table class="table table-bordered align-middle">
      <thead class="table-light text-center">
        <tr>
          <th>No</th>
          <th>Nama Project</th>
          <th>Focus</th>
          <th>Scheme</th>
          <th>Output</th>
          <th>Deadline</th>
        </tr>
      </thead>
      <tbody>
        @foreach($projects as $index => $project)
        <tr>
          <td class="text-center">{{ $index + 1 }}</td>
          <td>
            {{ $project->nama_project }}
          </td>
          <td class="text-center">{{ $project->fokus }}</td>
          <td class="text-center">{{ $project->skema }}</td>
          <td class="text-center">{{ $project->output }}</td>
          <td class="text-center">{{ \Carbon\Carbon::parse($project->deadline)->format('d/m/Y') }}</td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>

  <!-- Dummy Campus Tasks Table -->
  <div class="mb-5">
    <h4>Daftar Mata Kuliah dan Deadline</h4>
    <table class="table table-bordered table-striped">
      <thead class="table-light text-center">
        <tr>
          <th>No</th>
          <th>Nama Mata Kuliah</th>
          <th>Deadline Tugas / Proyek</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td class="text-center">1</td>
          <td>Enterprise Resource Planning</td>
          <td class="text-center">25 Juni 2025</td>
        </tr>
        <tr>
          <td class="text-center">2</td>
          <td>Business Process Management</td>
          <td class="text-center">28 Juni 2025</td>
        </tr>
        <tr>
          <td class="text-center">3</td>
          <td>Data Science</td>
          <td class="text-center">30 Juni 2025</td>
        </tr>
      </tbody>
    </table>
  </div>

</div>


  

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
