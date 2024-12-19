<?php
include_once "../includes/session.php"; // Adjust this to your session configuration file

// Unset all session variables
$_SESSION = array();

// Destroy the session
session_destroy();

// Redirect to login page or any other page after logout
header("Location: ../index.php");
exit();
?>
