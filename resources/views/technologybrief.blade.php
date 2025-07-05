<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Base Engineering</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
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
        <li class="nav-item"><a class="nav-link" href="{{ route('projects.index') }}">Projects</a></li>
        <li class="nav-item"><a class="nav-link active" href="{{ route('technologybrief.index') }}">Technology Brief</a></li>
        <li class="nav-item"><a class="nav-link" href="/login">Login/Registration</a></li>
      </ul>
    </div>
  </div>
</nav>

<!-- Banner & Intro -->
<section class="container my-5 text-center">
  <h2>Welcome to Base Engineering Indonesia</h2>
  
  <!-- Ukuran banner dikecilkan -->
  <img src="{{ asset('images/bannerbase.jpg') }}" class="img-fluid my-4 w-75 rounded" alt="Banner">
  
  <p class="lead">Riset Inovatif Produktif (RISPRO) adalah program pendanaan riset untuk meningkatkan daya saing bangsa melalui pendanaan riset terapan yang menghasilkan inovasi unggul dan berdampak pada sektor strategis nasional.</p>

  <h3 class="mt-5">Supported By</h3>

  <!-- Logo dikecilkan dan dirapikan -->
  <div class="d-flex justify-content-center align-items-center mt-3 flex-wrap gap-3">
    <img src="{{ asset('images/logo.png') }}" class="img-fluid" style="max-width: 100px;" alt="logo">
    <img src="{{ asset('images/logo.png') }}" class="img-fluid" style="max-width: 100px;" alt="logo">
    <img src="{{ asset('images/logo.png') }}" class="img-fluid" style="max-width: 100px;" alt="logo">
  </div>
</section>



<!-- Section: Technology Brief -->
<section class="container my-5">
  <h2 class="text-center"><i class="bi bi-journal-richtext me-2"></i>Technology Brief</h2>

  <!-- Tabs -->
  <ul class="nav nav-tabs justify-content-center mt-4" id="techTabs" role="tablist">
    <li class="nav-item" role="presentation">
      <button class="nav-link active" id="poster-tab" data-bs-toggle="tab" data-bs-target="#poster" type="button" role="tab">📄 Poster Gallery</button>
    </li>
    <li class="nav-item" role="presentation">
      <button class="nav-link" id="magazine-tab" data-bs-toggle="tab" data-bs-target="#magazine" type="button" role="tab">📘 Magazine</button>
    </li>
    <li class="nav-item" role="presentation">
      <button class="nav-link" id="video-tab" data-bs-toggle="tab" data-bs-target="#video" type="button" role="tab">🎥 Video</button>
    </li>
  </ul>

  <!-- Tab Content -->
  <div class="tab-content mt-4" id="techTabContent">

    <section class="container my-5">
  <h4 class="text-center mb-4"><i class="bi bi-card-image me-2"></i>Technology Brief</h4>

  <div class="row row-cols-1 row-cols-md-3 g-4">
    <!-- Poster 1 -->
    <div class="col">
      <div class="card h-100 shadow-sm">
        <a href="#" data-bs-toggle="modal" data-bs-target="#modal1">
          <img src="{{ asset('images/image.jpg') }}" class="card-img-top" alt="Theia L450">
        </a>
        <div class="card-body">
          <p class="card-text text-center text-primary">
            Perangkat 'Elisa Reader' Untuk Diagnosa Infeksi Virus Hepatitis B
          </p>
        </div>
      </div>
    </div>

     <div class="col">
      <div class="card h-100 shadow-sm">
        <a href="#" data-bs-toggle="modal" data-bs-target="#modal1">
          <img src="{{ asset('images/image.jpg') }}" class="card-img-top" alt="Theia L450">
        </a>
        <div class="card-body">
          <p class="card-text text-center text-primary">
            Perangkat 'Elisa Reader' Untuk Diagnosa Infeksi Virus Hepatitis B
          </p>
        </div>
      </div>
    </div>

     <div class="col">
      <div class="card h-100 shadow-sm">
        <a href="#" data-bs-toggle="modal" data-bs-target="#modal1">
          <img src="{{ asset('images/image.jpg') }}" class="card-img-top" alt="Theia L450">
        </a>
        <div class="card-body">
          <p class="card-text text-center text-primary">
            Perangkat 'Elisa Reader' Untuk Diagnosa Infeksi Virus Hepatitis B
          </p>
        </div>
      </div>
    </div>

     <div class="col">
      <div class="card h-100 shadow-sm">
        <a href="#" data-bs-toggle="modal" data-bs-target="#modal1">
          <img src="{{ asset('images/image.jpg') }}" class="card-img-top" alt="Theia L450">
        </a>
        <div class="card-body">
          <p class="card-text text-center text-primary">
            Perangkat 'Elisa Reader' Untuk Diagnosa Infeksi Virus Hepatitis B
          </p>
        </div>
      </div>
    </div>

     <div class="col">
      <div class="card h-100 shadow-sm">
        <a href="#" data-bs-toggle="modal" data-bs-target="#modal1">
          <img src="{{ asset('images/image.jpg') }}" class="card-img-top" alt="Theia L450">
        </a>
        <div class="card-body">
          <p class="card-text text-center text-primary">
            Perangkat 'Elisa Reader' Untuk Diagnosa Infeksi Virus Hepatitis a
          </p>
        </div>
      </div>
    </div>

     <div class="col">
      <div class="card h-100 shadow-sm">
        <a href="#" data-bs-toggle="modal" data-bs-target="#modal1">
          <img src="{{ asset('images/image.jpg') }}" class="card-img-top" alt="Theia L450">
        </a>
        <div class="card-body">
          <p class="card-text text-center text-primary">
            Perangkat 'Elisa Reader' Untuk Diagnosa Infeksi Virus Hepatitis B
          </p>
        </div>
      </div>
    </div>

     <div class="col">
      <div class="card h-100 shadow-sm">
        <a href="#" data-bs-toggle="modal" data-bs-target="#modal1">
          <img src="{{ asset('images/image.jpg') }}" class="card-img-top" alt="Theia L450">
        </a>
        <div class="card-body">
          <p class="card-text text-center text-primary">
            Perangkat 'Elisa Reader' Untuk Diagnosa Infeksi Virus Hepatitis B
          </p>
        </div>
      </div>
    </div>


 

<!-- MODALS -->

<!-- Modal 1 -->
<div class="modal fade" id="modal1" tabindex="-1" aria-labelledby="modalLabel1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalLabel1">Theia L450</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
      </div>
      <div class="modal-body text-center">
        <img src="{{ asset('images/B27_D.2.2_Poster.jpg') }}" class="img-fluid" alt="Theia L450">
        <p class="mt-3">Perangkat 'Elisa Reader' Untuk Diagnosa Infeksi Virus Hepatitis B</p>
      </div>
    </div>
  </div>
</div>

<!-- Modal 2 -->
<div class="modal fade" id="modal2" tabindex="-1" aria-labelledby="modalLabel2" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalLabel2">Patriot Net</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
      </div>
      <div class="modal-body text-center">
        <img src="{{ asset('images/patriot_net.png') }}" class="img-fluid" alt="Patriot Net">
        <p class="mt-3">
          Patriot-net: Prevention and Recovery Networks for Indonesia Natural Disasters Based On The Internet-of-things
        </p>
      </div>
    </div>
  </div>
</div>

<!-- Modal 3 -->
<div class="modal fade" id="modal3" tabindex="-1" aria-labelledby="modalLabel3" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalLabel3">Cokelat Probiotik</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
      </div>
      <div class="modal-body text-center">
        <img src="{{ asset('images/image.jpg') }}" class="img-fluid" alt="Cokelat Probiotik">
        <p class="mt-3">Cokelat Probiotik</p>
      </div>
    </div>
  </div>
</div>

<!-- Modal 4 -->
<div class="modal fade" id="modal4" tabindex="-1" aria-labelledby="modalLabel4" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalLabel4">Frangible Bullet</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
      </div>
      <div class="modal-body text-center">
        <img src="{{ asset('images/image.jpg') }}" class="img-fluid" alt="Frangible Bullet">
        <p class="mt-3">Proyektil Peluru Frangible Berbasis Material Komposit</p>
      </div>
    </div>
  </div>
</div>

<!-- Bootstrap Bundle JS (Modal needs this) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>


    <!-- Magazine -->
    <div class="tab-pane fade" id="magazine" role="tabpanel">
      <div class="alert alert-info text-center">Magazine content will be available soon.</div>
    </div>

    <!-- Video -->
    <div class="tab-pane fade" id="video" role="tabpanel">
      <div class="alert alert-info text-center">Video showcase will be added shortly.</div>
    </div>
  </div>
</section>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
