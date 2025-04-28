<?php
session_start(); // Start session

// Destroy all session data
session_unset();
session_destroy();

// Redirect to login page
header("Location: ../login.php"); // Change this to your login page
exit();
?>
