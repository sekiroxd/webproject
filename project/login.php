<?php
require_once("connection.php");
session_start();

function sanitize($data)
{
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

if (isset($_POST['login'])) {

  $adminusername="admin";
  $adminpassword="admin123";
  
  $email = sanitize($_POST['email']);
  $username = sanitize($_POST['username']);
  $inputpassword = sanitize($_POST['password']);
  $password = md5($inputpassword);

  if($username === $adminusername && $inputpassword === $adminpassword)
  {
    header("Location: admin.php");
    exit();
  }
  else
  {
  $sql = "SELECT * FROM users WHERE email = '$email' AND password = '$password' AND username = '$username' AND active = 1";
  $result = mysqli_query($conn, $sql);

  if (mysqli_num_rows($result) > 0) {
    $_SESSION['login_active'] = [$email, $password];
    header("Location: foglalas.php");
    exit();
  } else {
    $_SESSION['errors'] = "Bejelentkezési hiba! Kérlek ellenőrizd az emailed és jelszavad";
    header("Location: login.php");
    exit();
  }
 }
}

?>


<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="stylesheet" href="assets/css/fooldal.css">

  <title>Bejelentkezés</title>
</head>

<body>
   <nav class="nav">
    <ul>
        <li><a href="index.php">Főoldal</a></li>
        <li><a href="foglalas.php">Foglalások</a></li>
        <li><a href="signup.php">Regisztráció</a></li>
        <li><a href="login.php">Bejelentkezés</a></li>
    </ul>
  </nav>

  <div class="container text-center d-flex align-items-center min-vh-100">

    <div class="card mx-auto bg-info py-5" style="width: 25rem;">
      <h1>Bejelentkezés</h1>

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

      <div class="card-body">
        <form action="" method="post">
          <div class="mb-3">
            <label for="username" class="form-label">Felhasználónév</label>
            <input type="username" class="form-control" id="username" name="username">
          </div>
          <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email">
          </div>
          <div class="mb-3">
            <label for="password" class="form-label">Jelszó</label>
            <input type="password" class="form-control" id="password" name="password">
          </div>

          <button type="submit" class="btn btn-primary" name="login">Bejelentkezés</button>
        </form>
        <br>
        <a href="signup.php" class="btn btn-warning">Nincs fiókod? Regisztrálj itt</a>
        <br> <br>
        <a href="forgotpw.php" class="btn btn-warning">Elfelejtettem a jelszót :/</a>
      </div>
    </div>

  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>