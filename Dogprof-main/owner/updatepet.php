<?php
include '../connection/database.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $original_pet_nickname = $_POST['original_pet_nickname'];
    $pet_nickname = $_POST['pet_nickname'];
    $pet_name = $_POST['pet_name'];
    $birthday = $_POST['birthday'];
    $gender = $_POST['gender'];
    $breed = $_POST['breed'];
    $color = $_POST['color'];

    // Check if a new photo was uploaded
    if (!empty($_FILES['pet_photo']['name'])) {
        $photo_name = basename($_FILES['pet_photo']['name']);
        $photo_path = "../uploads/" . $photo_name;
        move_uploaded_file($_FILES['pet_photo']['tmp_name'], $photo_path);

        $stmt = $conn->prepare("UPDATE pet SET pet_nickname=?, pet_name=?, birthday=?, gender=?, breed=?, color=?, pet_photo=? WHERE pet_nickname=?");
        $stmt->bind_param("ssssssss", $pet_nickname, $pet_name, $birthday, $gender, $breed, $color, $photo_name, $original_pet_nickname);
    } else {
        $stmt = $conn->prepare("UPDATE pet SET pet_nickname=?, pet_name=?, birthday=?, gender=?, breed=?, color=? WHERE pet_nickname=?");
        $stmt->bind_param("sssssss", $pet_nickname, $pet_name, $birthday, $gender, $breed, $color, $original_pet_nickname);
    }

    if ($stmt->execute()) {
        header("Location: home.php");
        exit();
    } else {
        echo "Error updating pet: " . $conn->error;
    }

    $stmt->close();
} else {
    echo "Invalid request.";
}

$conn->close();
?>
              
