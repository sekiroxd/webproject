<?php
require_once("connection.php");
session_start();

if (isset($_SESSION['login_active'])) {
  echo "
        <script>
            alert('Már be vagy jelentkezve, nem kell regisztrálnod!');
        </script>";
}
?>

<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="stylesheet" href="assets/css/fooldal.css">

  <title>Regisztráció</title>
</head>

<body>

  <nav class="nav">
    <ul>
        <li><a href="index.php">Főoldal</a></li>
        <li><a href="foglalas.php">Foglalások</a></li>
        <li><a href="signup.php">Regisztráció</a></li>
        <li><a href="index.php">Bejelentkezés</a></li>
    </ul>
  </nav>

  <div class="container text-center d-flex align-items-center min-vh-100">
    <div class="card mx-auto bg-info pb-5 px-4" style="width: 25rem;">
      <h1 class="mt-5 text-center">Regisztráció</h1>
      <br>

      <?php if (isset($_SESSION['errors'])) : ?>
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
          <?php
          $message = $_SESSION['errors'];
          unset($_SESSION['errors']);
          echo $message;
          ?>
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      <?php endif; ?>

      <div>
        <form action="register.php" method="post" name="myForm" autocomplete="off">

          <div class="col-md-12 mb-3">
            <label class="form-label">Felhasználónév</label>
              <input type="text" name="username" class="form-control" required>
          </div>

          <div class="col-md-12 mb-3">
            <label class="form-label">Vezetéknév</label>
              <input type="text" name="last_name" class="form-control" required>
          </div>

          <div class="col-md-12 mb-3">
            <label class="form-label">Keresztnév</label>
              <input type="text" name="first_name" class="form-control" required>
          </div>

          <div class="col-md-12 mb-3">
            <label class="form-label">Email</label>
              <input type="email" name="email" class="form-control" required>
          </div>

          <div class="col-md-12 mb-3">
            <label class="form-label">Telefonszám</label>
              <input type="text" name="phone_num" class="form-control" required>
          </div>

          <div class="col-md-12 mb-3">
            <label class="form-label">Jelszó</label>
              <input type="password" name="password" class="form-control" required>
          </div>

          <div class="col-12 text-center mb-3">
            <button type="submit" class="btn btn-primary" name="signup">Regisztrálás</button>
          </div>
        </form>
      </div>
    </div>
</body>

</html>