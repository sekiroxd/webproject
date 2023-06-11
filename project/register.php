<?php
// Include the database configuration file
require_once 'db_config.php';

// Retrieve form data
$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$email = $_POST['email'];
$password = $_POST['password'];

if(strlen($_POST["password"]) < 8)
  {
    die("Password must be at least 8 charachters");
  }

  if( ! preg_match("/[0-9]/", $_POST["password"])) 
  {
    die("Password must contain at least one number");
  }
  
  if($_POST["password"] !== $_POST["password_confirmation"])
  {
    die("Passwords must match");
  }

// Insert the data into the database
$sql = "INSERT INTO users (first_name, last_name, email, password) VALUES ('$first_name', '$last_name', '$email', '$password')";


if ($conn->query($sql) === TRUE) {
    echo "Registration successful!";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close the database connection
$conn->close();
?>
