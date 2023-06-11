<!DOCTYPE html>
<html>
<head>
  <title>Regisztráció</title>
  <link rel="stylesheet" type="text/css" href="css/singup.css">
  <script scr="singupscript.js"></script>
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
  <h2>Regisztráció</h2>
  <form class="form" method="POST" action="register.php">
    <label for="first_name">Keresztnév :</label>
    <input type="text" name="first_name"><br>

    <label for="last_name">Vezetéknév :</label>
    <input type="text" name="last_name"><br>

    <label for="email">Email :</label>
    <input type="email" name="email"><br>

    <label for="password">Jelszó :</label>
    <input type="password" name="password"><br>

    <label for="password_confirmation">Jelszó újra :</label>
    <input type="password" id="password_confirmation" name="password_confirmation">
    <br>
    <input type="submit" value="Regisztrálás">
  </form>
  </div>
</body>
</html>