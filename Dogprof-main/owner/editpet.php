<?php
include '../connection/database.php';

if (isset($_GET['pet_nickname'])) {
    $pet_nickname = $_GET['pet_nickname'];

    $stmt = $conn->prepare("SELECT * FROM pet WHERE pet_nickname = ?");
    $stmt->bind_param("s", $pet_nickname);
    $stmt->execute();
    $result = $stmt->get_result();
    $pet = $result->fetch_assoc();
} else {
    echo "No pet selected.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Pet</title>
    <link rel="stylesheet" href="style/style.css">
</head>
<body>

<div class="content">
    <h2>Edit Pet Information</h2>
    <form action="updatepet.php" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="original_pet_nickname" value="<?php echo htmlspecialchars($pet['pet_nickname']); ?>">

        <label>Pet Nickname:</label>
        <input type="text" name="pet_nickname" value="<?php echo htmlspecialchars($pet['pet_nickname']); ?>" required>

        <label>Pet Full Name:</label>
        <input type="text" name="pet_name" value="<?php echo htmlspecialchars($pet['pet_name']); ?>" required>

        <label>Birthday:</label>
        <input type="date" name="birthday" value="<?php echo htmlspecialchars($pet['birthday']); ?>" required>

        <label>Gender:</label>
        <select name="gender" required>
            <option value="Male" <?php if ($pet['gender'] == 'Male') echo 'selected'; ?>>Male</option>
            <option value="Female" <?php if ($pet['gender'] == 'Female') echo 'selected'; ?>>Female</option>
        </select>

        <label>Breed:</label>
        <input type="text" name="breed" value="<?php echo htmlspecialchars($pet['breed']); ?>" required>

        <label>Color:</label>
        <input type="text" name="color" value="<?php echo htmlspecialchars($pet['color']); ?>" required>

        <label>Change Pet Photo (Optional):</label>
        <input type="file" name="pet_photo" accept="image/*">

        <button type="submit">Update Pet</button>
    </form>
</div>

</body>
</html>

<?php
$conn->close();
?>
