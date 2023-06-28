<?php session_start(); ?>
<?php

require 'connection.php';

if (isset($_GET['token'])) {

	$token = $_GET['token'];
	
	$sql = "UPDATE users SET active = '1' WHERE token = '$token'";

	if (mysqli_query($conn, $sql)) {
		$_SESSION['errors'] = "Fiók aktiválva, mostmár bejelentkezhetsz";
      	header('Location: https://kfs.stud.vts.su.ac.rs/login.php');
      	exit;
	}

} else {
	$_SESSION['errors'] = "Fiók aktiválása sikertelen!";
    header('Location: https://kfs.stud.vts.su.ac.rs/singup.php');
    exit;
}
?>
