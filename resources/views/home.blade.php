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

  <!-- Chart Section -->
  <section class="container my-5">
    <h4 class="text-center mb-4">RISPRO Research Focus Area (Number of Projects)</h4>
    <p class="text-center text-muted">Total: 3444 Projects (since 2013)</p>
    <canvas id="risproChart" height="600"></canvas>
  </section>

  <!-- Output & Outcome Section -->
<section class="container my-5">
  <h4 class="text-center mb-4">Output & Outcome</h4>
  <div class="row text-center g-4">

    <!-- Output cards -->
    <div class="col-md-3">
      <div class="border p-3 rounded shadow-sm">
        <i class="bi bi-cpu fs-1 text-primary"></i>
        <h5 class="mt-2">1.900</h5>
        <p class="text-muted">Product / Technology</p>
      </div>
    </div>

    <div class="col-md-3">
      <div class="border p-3 rounded shadow-sm">
        <i class="bi bi-journal-text fs-1 text-primary"></i>
        <h5 class="mt-2">187</h5>
        <p class="text-muted">Policy / Model</p>
      </div>
    </div>

    <div class="col-md-3">
      <div class="border p-3 rounded shadow-sm">
        <i class="bi bi-buildings fs-1 text-primary"></i>
        <h5 class="mt-2">77</h5>
        <p class="text-muted">New Business Entity</p>
      </div>
    </div>

    <div class="col-md-3">
      <div class="border p-3 rounded shadow-sm">
        <i class="bi bi-award fs-1 text-primary"></i>
        <h5 class="mt-2">33</h5>
        <p class="text-muted">License</p>
      </div>
    </div>

    <div class="col-md-3">
      <div class="border p-3 rounded shadow-sm">
        <i class="bi bi-card-heading fs-1 text-primary"></i>
        <h5 class="mt-2">2.960</h5>
        <p class="text-muted">Intellectual Property Rights</p>
      </div>
    </div>

    <div class="col-md-3">
      <div class="border p-3 rounded shadow-sm">
        <i class="bi bi-cash-coin fs-1 text-primary"></i>
        <h5 class="mt-2">Rp44 Billion</h5>
        <p class="text-muted">Partners Contribution</p>
      </div>
    </div>

    <div class="col-md-3">
      <div class="border p-3 rounded shadow-sm">
        <i class="bi bi-mortarboard fs-1 text-primary"></i>
        <h5 class="mt-2">7.606</h5>
        <p class="text-muted">Graduate</p>
      </div>
    </div>

    <div class="col-md-3">
      <div class="border p-3 rounded shadow-sm">
        <i class="bi bi-box-seam fs-1 text-primary"></i>
        <h5 class="mt-2">Rp94 Billion</h5>
        <p class="text-muted">Assets Utilized</p>
      </div>
    </div>

    <div class="col-md-3">
      <div class="border p-3 rounded shadow-sm">
        <i class="bi bi-people fs-1 text-primary"></i>
        <h5 class="mt-2">85</h5>
        <p class="text-muted">Beneficiary Community</p>
      </div>
    </div>

    <div class="col-md-3">
      <div class="border p-3 rounded shadow-sm">
        <i class="bi bi-handshake fs-1 text-primary"></i>
        <h5 class="mt-2">170</h5>
        <p class="text-muted">New Partnership</p>
      </div>
    </div>

    <div class="col-md-3">
      <div class="border p-3 rounded shadow-sm">
        <i class="bi bi-journals fs-1 text-primary"></i>
        <h5 class="mt-2">5.812</h5>
        <p class="text-muted">Publication</p>
      </div>
    </div>

    <div class="col-md-3">
      <div class="border p-3 rounded shadow-sm">
        <i class="bi bi-star fs-1 text-primary"></i>
        <h5 class="mt-2">598</h5>
        <p class="text-muted">Awards & Recognition</p>
      </div>
    </div>
  </div>
</section>


  <!-- Chart Script -->
  <script>
    const ctx = document.getElementById('risproChart').getContext('2d');
    new Chart(ctx, {
      type: 'bar',
      data: {
        labels: [
          'Health & Medicine', 'Socio Humaniora, Art, Culture, & Education', 'Food, Agriculture, and Forestry',
          'Engineering Products', 'Energy & Renewable Energy', 'Nanotechnology & Advanced Material',
          'Disaster Management, Climate Change, Water, & Environment', 'Information and Communication Technology',
          'Economy Creative & Tourism', 'Green Economy', 'Blue Economy', 'Maritime',
          'Biodiversity and Biological Resources', 'Transportation', 'Defence & Security',
          'Aeronautics and Space', 'Geology and Earth', 'Nuclear'
        ],
        datasets: [{
          label: 'Projects',
          data: [829, 711, 527, 358, 204, 131, 112, 111, 111, 93, 78, 77, 28, 27, 25, 6, 5, 5],
          backgroundColor: 'rgba(54, 162, 235, 0.6)',
          borderColor: 'rgba(54, 162, 235, 1)',
          borderWidth: 1
        }]
      },
      options: {
        indexAxis: 'y',
        responsive: true,
        plugins: {
          legend: { display: false },
          title: {
            display: false
          }
        },
        scales: {
          x: {
            beginAtZero: true,
            title: {
              display: true,
              text: 'Number of Projects'
            }
          }
        }
      }
    });
  </script>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
