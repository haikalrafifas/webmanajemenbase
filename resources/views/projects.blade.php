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
          <li class="nav-item"><a class="nav-link" href="/">Home</a></li>
          <li class="nav-item"><a class="nav-link active" href="{{ route('projects.index') }}">Projects</a></li>
          <li class="nav-item"><a class="nav-link" href="{{ route('technologybrief.index') }}">Technology Brief</a></li>
          <li class="nav-item"><a class="nav-link" href="/login">Login/Registration</a></li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Banner & Intro -->
  <section class="container my-5 text-center">
    <h2>Welcome to Base Engineering Indonesia</h2>
    <img src="{{ asset('images/bannerbase.jpg') }}" class="img-fluid my-4" alt="Banner">
    <p class="lead">Riset Inovatif Produktif (Base Engineering) adalah program pendanaan riset untuk meningkatkan daya saing bangsa melalui pendanaan riset terapan yang menghasilkan inovasi unggul dan berdampak pada sektor strategis nasional.</p>

    <h3 class="mt-5">Supported By</h3>
    <div class="d-flex justify-content-center mt-3">
      <img src="https://via.placeholder.com/60" class="mx-2" alt="logo">
      <img src="https://via.placeholder.com/60" class="mx-2" alt="logo">
      <img src="https://via.placeholder.com/60" class="mx-2" alt="logo">
    </div>
  </section>

  <!-- Project Filter -->
  <section class="container mb-4">
    <h3 class="text-center mb-4"><i class="bi bi-card-list"></i> Base Engineering</h3>
    <div class="row g-3">
      <div class="col-md-2"><select class="form-select"><option>All Project Status</option></select></div>
      <div class="col-md-2"><select class="form-select"><option>All Scheme</option></select></div>
      <div class="col-md-2"><select class="form-select"><option>All Types</option></select></div>
      <div class="col-md-2"><select class="form-select"><option>All Focus</option></select></div>
      <div class="col-md-2"><select class="form-select"><option>All Year</option></select></div>
      <div class="col-md-2"><input type="text" class="form-control" placeholder="Search project title..."></div>
    </div>
  </section>

  <!-- Projects Table -->
  <section class="container mb-5">
    <div class="table-responsive">
      <table class="table table-bordered align-middle text-center">
        <thead class="table-light">
          <tr>
            <th>No</th>
            <th>Project</th>
            <th>PIC</th>
            <th>Project Info</th>
          </tr>
        </thead>
        <tbody>
          {{-- Contoh data statis, bisa diganti dengan @foreach --}}
          <tr>
            <td>1</td>
            <td>
              Komersialisasi Mesin CNC dengan Kemampuan Multi Fungsi<br>
              <button class="btn btn-outline-primary btn-sm mt-2"><i class="bi bi-eye"></i> see abstract</button>
            </td>
            <td>- HARKI APRI YANTO Ph.D<br><small>Politeknik Manufaktur Astra</small></td>
            <td class="text-start">
              <span class="badge bg-purple text-white mb-1">Competition</span><br>
              <strong>Focus:</strong> Information and Communication<br>
              <strong>Output:</strong> Product/Technology<br>
              <small>1/2 (finished)</small>
            </td>
          </tr>
          <tr>
            <td>2</td>
            <td>
              MODEL PENGUKURAN IMPLEMENTASI SISTEM INOVASI DAERAH (SIDA)<br>
              <button class="btn btn-outline-primary btn-sm mt-2"><i class="bi bi-eye"></i> see abstract</button>
            </td>
            <td>Dr. Nimas Maninggar S.T., M.T.<br><small>Badan Riset dan Inovasi Nasional</small></td>
            <td class="text-start">
              <span class="badge bg-purple text-white mb-1">Competition</span><br>
              <strong>Focus:</strong> Tourism Development and Creative Economy<br>
              <strong>Output:</strong> Policy/Model<br>
              <small>1/2 (finished)</small>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </section>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

  <style>
    .bg-purple {
      background-color: #6f42c1 !important;
    }
  </style>

</body>
</html>
