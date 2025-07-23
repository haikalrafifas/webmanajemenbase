<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Permintaan Join Proyek - Admin</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
</head>
<body>

<!-- Navbar -->
@include('admin.partials.navbar')

<!-- Main Content -->
<div class="container mt-5">
  <h4 class="mb-4">Permintaan Join Proyek</h4>

  <div class="table-responsive">
    <table class="table table-bordered align-middle">
      <thead class="table-light text-center">
        <tr>
          <th>No</th>
          <th>Nama Anggota</th>
          <th>Project</th>
          <th>Tanggal Request</th>
          <th>Status</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        @forelse ($requests as $index => $request)
        <tr class="text-center">
          <td>{{ $index + 1 }}</td>
          <td>{{ $request->user_name }}</td>
          <td>{{ $request->nama_project }}</td>
          <td>{{ \Carbon\Carbon::parse($request->created_at)->translatedFormat('d F Y H:i') }}</td>
          <td>
            <span class="badge bg-warning text-dark">{{ ucfirst($request->status) }}</span>
          </td>
          <td>
            <form action="{{ route('admin.project.request.accept', ['id' => $request->id]) }}" method="POST" class="d-inline">
              @csrf
              <input type="hidden" name="project_id" value="{{ $request->project_id }}">
              <input type="hidden" name="user_id" value="{{ $request->user_id }}">
              <button class="btn btn-sm btn-success">Terima</button>
            </form>

            <form action="{{ route('admin.project.request.reject', $request->id) }}" method="POST" class="d-inline">
              @csrf
              <button class="btn btn-sm btn-danger">Tolak</button>
            </form>
          </td>
        </tr>
        @empty
        <tr>
          <td colspan="6" class="text-center text-muted">Belum ada permintaan masuk.</td>
        </tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
