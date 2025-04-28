<?php
include '../connection/database.php'; // your database connection
session_start(); // start session to get logged-in user

// Check if the user is logged in
if (!isset($_SESSION['ownerID'])) {
    // If not logged in, redirect to login page
    header("Location: ../login.php");
    exit();
}

$owner_id = $_SESSION['ownerID']; // get the current owner's ID from session

// Fetch only the pets owned by the logged-in user
$sql = "SELECT * FROM pet WHERE ownerID = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $owner_id);
$stmt->execute();
$result = $stmt->get_result();
?>

