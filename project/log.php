<!DOCTYPE html>
<html>
<head>
  <title>Bejelentkezés</title>
  <link rel="stylesheet" type="text/css" href="css/login.css">
</head>
<body>
  
  <nav class="nav">
    <ul>
        <li><a href="fooldal.php">Főoldal</a></li>
        <li><a href="#">Foglalások</a></li>
        <li><a href="singup.php">Regisztráció</a></li>
        <li><a href="log.php">Bejelentkezés</a></li>
        <li><a href="#">Admin</a></li>
    </ul>
  </nav>

     <div class="container">
    <h2>Login</h2>
    <form method="POST" action="login.php">
      <label for="email">Email:</label>
      <input type="email" name="email" required><br>

      <label for="password">Password:</label>
      <input type="password" name="password" required><br>

      <input type="submit" value="Log In">
    </form>
  </div>


</body>
