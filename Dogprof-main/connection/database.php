<?php
$host = 'localhost';
$db = 'dogprofile';
$user = 'root';
$pass = ''; // change this if your MySQL has a password

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
