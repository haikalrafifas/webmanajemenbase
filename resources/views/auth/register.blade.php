<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Register | Base Engineering</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  <div class="container mt-5" style="max-width: 400px;">
    <h3 class="text-center mb-4">Register</h3>

    @if($errors->any())
      <div class="alert alert-danger">
        <ul class="mb-0">
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <form method="POST" action="{{ url('/register') }}" enctype="multipart/form-data">
      @csrf

      <div class="mb-3">
        <label for="name" class="form-label">Full Name</label>
        <input type="text" name="name" id="name" class="form-control" required>
      </div>

      <div class="mb-3">
        <label for="email" class="form-label">Email address</label>
        <input type="email" name="email" id="email" class="form-control" required>
      </div>

      <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" name="password" id="password" class="form-control" required>
      </div>

         <div class="mb-3">
        <label for="password_confirmation" class="form-label">Confirm Password</label>
        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required>
      </div>


      <!-- NIM / NIP -->
      <div class="mb-3">
        <label for="identitas" class="form-label">NIM (Anggota) / NIP (Admin)</label>
        <input type="text" name="identitas" id="identitas" class="form-control" required>
      </div>

      <!-- Program Studi -->
      <div class="mb-3">
        <label for="program_studi" class="form-label">Program Studi</label>
        <input type="text" name="program_studi" id="program_studi" class="form-control" required>
      </div>

      <div class="mb-3">
  <label for="profile_photo" class="form-label">Profile Photo</label>
  <input type="file" name="profile_photo" id="profile_photo" class="form-control" accept="image/*">
</div>



   
      <div class="mb-3">
        <label for="role" class="form-label">Register as</label>
        <select name="role" id="role" class="form-select" required>
          <option value="" disabled selected>-- Select Role --</option>
          <option value="admin">Admin</option>
          <option value="anggotabase">Anggota Base</option>
        </select>
      </div>

     

      <button type="submit" class="btn btn-success w-100">Register</button>

      <div class="text-center mt-3">
        <a href="{{ route('login') }}">Already have an account? Login</a>
      </div>
    </form>
  </div>
</body>
</html>
