<?php
require_once("connection.php");
session_start();
session_destroy();

header("Location: login.php");
exit();