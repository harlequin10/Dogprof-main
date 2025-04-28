<?php
include '../connection/database.php';
session_start();

// Make sure user is logged in
if (!isset($_SESSION['ownerID'])) {
    header("Location: ../login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $pet_nickname = $_POST['pet_nickname'];
    $pet_name = $_POST['pet_name'];
    $birthday = $_POST['birthday'];
    $gender = $_POST['gender'];
    $breed = $_POST['breed'];
    $color = $_POST['color'];
    $owner_id = $_SESSION['ownerID'];

    $pet_photo = '';
    if (isset($_FILES['pet_photo']) && $_FILES['pet_photo']['error'] == 0) {
        $photo_tmp = $_FILES['pet_photo']['tmp_name'];
        $photo_name = time() . '_' . basename($_FILES['pet_photo']['name']); // Example: 1711234567_dog.jpg
        $upload_dir = '../uploads/'; // adjust if needed based on your file structure
        $target_path = $upload_dir . $photo_name;

        if (move_uploaded_file($photo_tmp, $target_path)) {
            $pet_photo = $photo_name; // only save the filename, not the path
        } else {
            echo "Failed to upload pet photo!";
            exit();
        }
    }

    $stmt = $conn->prepare("INSERT INTO pet (pet_nickname, pet_name, birthday, gender, breed, color, pet_photo, ownerID) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssssi", $pet_nickname, $pet_name, $birthday, $gender, $breed, $color, $pet_photo, $owner_id);

    if ($stmt->execute()) {
        header("Location: home.php");
        exit();
    } else {
        echo "Database insert error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
