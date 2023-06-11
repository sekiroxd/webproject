<?php
require_once 'db_config.php';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Retrieve form data
  $email = $_POST['email'];
  $password = $_POST['password'];


  // Prepare a SQL query to retrieve user data
  $sql = "SELECT * FROM users WHERE email = '$email'";

  // Execute the query
  $result = $conn->query($sql);

  // Check if the query returned any results
  if ($result->num_rows === 1) {
    // Fetch the user data from the result
    $row = $result->fetch_assoc();
    $storedPassword = $row['password'];


    // Verify the password
    if ($password === $storedPassword) {
      // Password is correct, login successful
      echo "Login successful!";
    } else {
      // Invalid password
      echo "Invalid password. Please try again.";
    }
  } else {
    // Invalid email
    echo "Invalid email or password. Please try again.";
  }

  // Close the database connection
  $conn->close();
}
?>
