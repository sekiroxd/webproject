<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Jelszó váltás</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>
<body>
    <div class="container d-flex justify-content-center mt-5 pt-5">
        <div class="card mt-5" style="width:500px">
            <div class="card-header">
                <h2 class="text-center">Jelszó módosítása</h2>
            </div>
            <div class="card-body">
                <form method="post">
                    <div class="mt-4">
                        <label for="email">Email : </label> <br>
                        <input type="email" name="email" class="form-control">
                    </div>
                    <div class="mt-4 text-end">
                        <input type="submit" name="send-link" class="btn btn-primary">
                        <a href="login.php" class="btn btn-danger">Vissza</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

<?php
session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';
require 'connection.php';

if (isset($_POST['send-link'])) {
  $email = ($_POST['email']);

   $sql = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
   $query = mysqli_num_rows($sql);
   $fetch = mysqli_fetch_assoc($sql);
   
   if(mysqli_num_rows($sql) <= 0){
    echo "
      <script>
          alert('Nem található ilyen email!');
      </script>";
    exit;
  }
  else if($fetch["active"] == 0){
    echo "
      <script>
          alert('A fiókot verifikálni kell mielőtt jelszóváltást kérhetne');
      </script>";
      exit;
  }
  else {
     $pw_token = bin2hex(random_bytes(50));
      
     $_SESSION['pw_token'] = $pw_token;
     $_SESSION['email'] = $email;

     $query = "UPDATE users SET pw_token='$pw_token' WHERE email='$email'";
     $result = mysqli_query($conn, $query);
        
    require "phpmailer/PHPMailerAutoload.php"; 
    $mail = new PHPMailer;
        
    $mail->isSMTP();
    $mail->Host='smtp.gmail.com';
    $mail->Port=587;
    $mail->SMTPAuth=true;
    $mail->SMTPSecure='tls';
      
     $mail->Username='balinttamas23@gmail.com';
     $mail->Password='wcqxaoujwpkbkzyl';
        
                    $mail->setFrom('balinttamas23@gmail.com', '');
                    $mail->addAddress($_POST["email"]);
        
                    $mail->isHTML(true);
                    $mail->Subject="Jelszo Frissites";
                    $mail->Body="<b>Kedves Felhasználó!</b>
                    <p>A következő linken tudja megváltoztatni a jelszavát</p>
                    https://kfs.stud.vts.su.ac.rs/updatepw.php?token=" . $pw_token;
        
                    if(!$mail->send()){
                        echo "
                        <script>
                        alert('Invalid email');
                        </script>";
                        exit;
                    }else{
                     echo "
                        <script>
                        alert('Kérem nézze meg az emailjét a jelszó változtatásához!');
                        </script>";  
                    }
                }
              }
?>
</body>
</html>