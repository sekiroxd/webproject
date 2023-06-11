<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "restaurant";

// Create a database connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Az adatbázishoz való csatlakozás problémába ütközött: " . $conn->connect_error);
}
?>

<?php 
// const PARAMS = [
//     "HOST" => 'localhost',
//     "USER" => 'root',
//     "PASS" => '',
//     "DBNAME" => 'restaurant',
//     "CHARSET" => 'utf8mb4'
// ];

// const SITE = 'http://localhost/weboldal/project/'; // enter your path on localhost

// $dsn = "mysql:host=" . PARAMS['HOST'] . ";dbname=" . PARAMS['DBNAME'] . ";charset=".PARAMS['CHARSET'];

// $pdoOptions = [
//     PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
//     PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
//     PDO::ATTR_EMULATE_PREPARES => false
// ];

// $actions = ['login', 'register', 'forget'];

// $messages = [
//     0 => 'No direct access!',
//     1 => 'Unknown user!',
//     2 => 'User with this name already exists, choose another one!',
//     3 => 'Check your email to active your account!',
//     4 => 'Fill all the fields!',
//     5 => 'You are logged out!!',
//     6 => 'Your account is activated, you can login now!',
//     7 => 'Passwords are not equal!',
//     8 => 'Format of e-mail address is not valid!',
//     9 => 'Password is too short! It must be minimum 8 characters long!',
//     10 => 'Password is not enough strong! (min 8 characters, at least 1 lowercase character, 1 uppercase character, 1 number, and 1 special character',
//     11 => 'Something went wrong with mail server. We will try to send email later!',
//     12 => 'Your account is already activated!'
// ]; 
?>