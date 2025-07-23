<!-- Navbar -->
<nav class="navbar navbar-expand-lg bg-light shadow-sm">
  <div class="container">
    <a class="navbar-brand fw-bold" href="#">Base Engineering Indonesia</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item"><a class="nav-link active" href="/admin">Dashboard</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ route('admin.statistics') }}">Statistics</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ route('admin.baseproject') }}">Base Project</a></li>
 <li class="nav-item"><a class="nav-link" href="{{ route('admin.activityreport') }}">Activity Report</a></li>
   <li class="nav-item"><a class="nav-link" href="{{ route('admin.project.requests') }}">Request Masuk</a></li>
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