<?php
include '../connection/database.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize input
    $email = trim($_POST['email']);
    $password = trim($_POST['Password']);

    // Check if fields are not empty
    if (empty($email) || empty($password)) {
        echo "❌ Email and password are required.";
        exit();
    }

    // Prepare SQL statement
    $stmt = $conn->prepare("SELECT ownerID, email, Password FROM owner WHERE email = ?");
    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }

    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    // Verify user
    if ($user = $result->fetch_assoc()) {
        if (password_verify($password, $user['Password'])) {
            $_SESSION['ownerID'] = $user['ownerID'];
            $_SESSION['ownerEmail'] = $user['email']; // ✅ Store email in session
            
            header("Location: ../owner/home.php");
            exit();
        } else {
            echo "❌ Invalid password.";
        }
    } else {
        echo "❌ No user found.";
    }

    $stmt->close();
    $conn->close();
}
?>
