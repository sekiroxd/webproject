<?php
require_once 'connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = $conn->prepare("SELECT user_id FROM users");
    $stmt->execute();
    $stmt->bind_result($user_id);
    $stmt->fetch();
    $stmt->close();

    if (isset($_POST['update_username'])) {
        $username = $_POST['username'];
        $stmt = $conn->prepare("UPDATE users SET username = ? WHERE user_id = '$user_id'");
        $stmt->bind_param("s", $username);
        if($stmt->execute())
        {
          echo "
      <script>
          alert('Felhasználónév sikeresen frissült!');
      </script>";
        }
        $stmt->close();
    }

    if (isset($_POST['update_last_name'])) {
        $last_name = $_POST['last_name'];
        $stmt = $conn->prepare("UPDATE users SET last_name = ? WHERE user_id = '$user_id'");
        $stmt->bind_param("s", $last_name);
        if($stmt->execute())
        {
          echo "
      <script>
          alert('Vezetéknév sikeresen frissült!');
      </script>";
        }
        $stmt->close();
    }

    if (isset($_POST['update_first_name'])) {
        $first_name = $_POST['first_name'];
        $stmt = $conn->prepare("UPDATE users SET first_name = ? WHERE user_id = '$user_id'");
        $stmt->bind_param("s", $first_name);
        if($stmt->execute())
        {
          echo "
      <script>
          alert('Keresztnév sikeresen frissült!');
      </script>";
        }
        $stmt->close();
    }

    if (isset($_POST['update_phone_num'])) {
        $phone_num = $_POST['phone_num'];
        $stmt = $conn->prepare("UPDATE users SET phone_num = ? WHERE user_id = '$user_id'");
        $stmt->bind_param("s", $phone_num,);
        if($stmt->execute())
        {
          echo "
      <script>
          alert('Telefonszám sikeresen frissült!');
      </script>";
        }
        $stmt->close();
    }

    if (isset($_POST['update_all'])) {
        $username = $_POST['username'];
        $last_name = $_POST['last_name'];
        $first_name = $_POST['first_name'];
        $phone_num = $_POST['phone_num'];

        $stmt = $conn->prepare("UPDATE users SET username = ?, last_name = ?, first_name = ?, phone_num = ? WHERE user_id = '$user_id'");
        $stmt->bind_param("ssss", $username, $last_name, $first_name, $phone_num);
        if ($stmt->execute()) {
            echo "
            <script>
                alert('Az összes adat sikeresen frissült!');
            </script>";
        }
        $stmt->close();
    }
}

?>


<!DOCTYPE html>
<html>
<head>
    <title>Fiók frissítése</title>
    <style>
        body {
            background-color: #f2f2f2;
        }

        .container {
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            background-color: #ffffff;
            border: 1px solid #cccccc;
            border-radius: 5px;
            margin-top: 50px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            color: #333333;
            font-weight: bold;
        }

        .form-group input {
            width: 90%;
            padding: 10px;
            border: 1px solid #cccccc;
            border-radius: 5px;
            margin-bottom: 10px;
        }

        .form-group button {
            padding: 10px 20px;
            background-color: #4c86a8;
            color: #ffffff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .link a
        {
          padding: 10px 10px;
          background-color: #4c86a8;
          color: #ffffff;
          border: none;
          border-radius: 5px;
          cursor: pointer;
          text-decoration: none;
          margin-left: 35%;
        }

        .form-group a
        {
          padding: 9px 10px;
          background-color: #D2042D;
          color: #ffffff;
          border: none;
          border-radius: 5px;
          cursor: pointer;
          text-decoration: none;
          margin-left: 110px;
        }

    </style>
</head>
<body>
<div class="container">
    <h2 style="text-align:center">Adataim megváltoztatása</h2>
    <form method="POST" action="change_account.php">
        <div class="form-group">
            <label for="username">Felhasználónév : </label>
            <input type="text" id="username" name="username">
            <button type="submit" name="update_username">Frissítés</button>
        </div>
        <div class="form-group">
            <label for="last_name">Vezetéknév : </label>
            <input type="text" id="last_name" name="last_name">
            <button type="submit" name="update_last_name">Frissítés</button>
        </div>
        <div class="form-group">
            <label for="first_name">Keresztnév : </label>
            <input type="text" id="first_name" name="first_name">
            <button type="submit" name="update_first_name">Frissítés</button>
        </div>
        <div class="form-group">
            <label for="phone_num">Telefonszám : </label>
            <input type="text" id="phone_num" name="phone_num">
            <button type="submit" name="update_phone_num">Frissítés</button>
        </div>
        <div class="link">
            <a href="forgotpw.php">Jelszó frissítése</a>
        </div>
        <br><br>
        <div class="form-group">
          <button type="submit" name="update_all">Össz frissítése</button> 
          <a href="foglalas.php">Vissza a foglalásra</a>
        </div>
    </form>
</div>
</body>
</html>
