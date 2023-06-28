<?php session_start(); ?>
<?php

echo ini_get('display_errors');

if (!ini_get('display_errors')) {
    ini_set('display_errors', '1');
}

echo ini_get('display_errors');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';
require 'connection.php';

function sanitize($data)
{
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

if (isset($_POST['signup'])) {
  $username = sanitize($_POST['username']);
  $fname = sanitize($_POST['first_name']);
  $lname = sanitize($_POST['last_name']);
  $email = sanitize($_POST['email']);
  $phone_num = ($_POST['phone_num']);
  $password = sanitize($_POST['password']);
  $pw_token = "";

  $username = mysqli_real_escape_string($conn, $username);
  $fname = mysqli_real_escape_string($conn, $fname);
  $lname = mysqli_real_escape_string($conn, $lname);
  $email = mysqli_real_escape_string($conn, $email);
  $password = mysqli_real_escape_string($conn, $password);

  $username_check = mysqli_query($conn, "SELECT username FROM users WHERE username='$username'");
  $username_query = mysqli_num_rows($username_check);

  if ($username_query != 0) {
    echo "
      <script>
          alert('Ez a felhasználónév már foglalt!');
          window.location.href='signup.php';
      </script>";
    exit;
  }

  $email_check = mysqli_query($conn, "SELECT email FROM users WHERE email='$email'");
  $email_query = mysqli_num_rows($email_check);

  if ($email_query != 0) {
    echo "
      <script>
          alert('Ez az email cím már foglalt!');
          window.location.href='signup.php';
      </script>";
    exit;
  }
     

  $hashedPass = md5($password);
  $active = 0;

  $token = bin2hex(random_bytes(15));

  $sql = "INSERT INTO users (username, first_name, last_name, email, phone_num, password, token, pw_token, active) VALUES('$username','$fname', '$lname', '$email', '$phone_num','$hashedPass', '$token', '$pw_token' ,'$active')";


  $result = mysqli_query($conn, $sql);

    require_once "phpmailer/PHPMailerAutoload.php";
    $mail = new PHPMailer;

      $mail->isSMTP();
      $mail->Host       = 'smtp.gmail.com';
      $mail->Port       = 587;
      $mail->SMTPAuth   = true;
      $mail->SMTPSecure = 'tls';

      $mail->Username   = 'balinttamas23@gmail.com';          
      $mail->Password   = 'wcqxaoujwpkbkzyl';

      $mail->setFrom('balinttamas23@gmail.com', ''); 
      $mail->addAddress($_POST["email"]);    

      $mail->isHTML(true);
      $mail->Subject = 'Email validalas';    
      $mail->Body    = "Kellemes napot $lname $fname! Kérem kattintson a linkre, hogy verifikálja a fiókját :
      https://kfs.stud.vts.su.ac.rs/activate.php?token=" . $token;
      $mail->send();

      $_SESSION['errors'] = "Sikeres regisztrálás. Kérem nézze meg az emailjét a fiók aktiválásához!";
      header('Location: login.php');
      exit;
    }
?>