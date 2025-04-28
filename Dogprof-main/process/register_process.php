<?php
include '../connection/database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $first_name = $_POST['First_Name'];
    $last_name = $_POST['Last_Name'];
    $gender = $_POST['Gender'];
    $password = password_hash($_POST['Password'], PASSWORD_DEFAULT); // 🟡 hashed!
    $contact = $_POST['ContactNum'];

    $sql = "INSERT INTO owner (email, First_Name, Last_Name, Gender, Password, ContactNum)
            VALUES (?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }

    $stmt->bind_param("ssssss", $email, $first_name, $last_name, $gender, $password, $contact);

    if ($stmt->execute()) {
        header("Location: ../login.php");
        echo "✅ Registered successfully.";
    } else {
        echo "❌ Registration failed: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>

