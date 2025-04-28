<?php
include '../connection/database.php';

if (isset($_GET['pet_nickname'])) {
    $pet_nickname = $_GET['pet_nickname'];

    $stmt = $conn->prepare("DELETE FROM pet WHERE pet_nickname = ?");
    $stmt->bind_param("s", $pet_nickname);

    if ($stmt->execute()) {
        header("Location: home.php");
        exit();
    } else {
        echo "Error deleting pet: " . $conn->error;
    }

    $stmt->close();
} else {
    echo "Pet nickname not provided.";
}

$conn->close();
?>
