<?php
include '../connection/database.php';
include 'read.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Pawkedex</title>
    <link rel="stylesheet" href="style/style.css">
</head>
<body>

<div class="sidebar">
    <h2 style="text-align:center;">PAWKEDEX</h2>
    <a href="" class="active">All Pets</a>
    <a href="home.php">Your Pet Dogs</a>
    <a href="logout.php">Logout</a>
</div>

<div class="content">
    <?php if ($result->num_rows > 0): ?>
        <?php while($row = $result->fetch_assoc()): ?>
            <div class="card" onclick="openPetDetails('<?php echo htmlspecialchars(addslashes($row['pet_nickname'])); ?>',
                                                      '<?php echo htmlspecialchars(addslashes($row['pet_name'])); ?>',
                                                      '<?php echo htmlspecialchars(addslashes($row['birthday'])); ?>',
                                                      '<?php echo htmlspecialchars(addslashes($row['gender'])); ?>',
                                                      '<?php echo htmlspecialchars(addslashes($row['breed'])); ?>',
                                                      '<?php echo htmlspecialchars(addslashes($row['color'])); ?>',
                                                      '../uploads/<?php echo htmlspecialchars(addslashes($row['pet_photo'])); ?>')">
                <div style="padding:10px;">
                    <h4><?php echo htmlspecialchars($row['pet_nickname']); ?>, 
                        <?php 
                            $birthdate = new DateTime($row['birthday']);
                            $today = new DateTime();
                            $age = $today->diff($birthdate)->y;
                            echo $age . " y.o.";
                        ?>
                    </h4>
                    <p><small><b>Breed:</b> <?php echo htmlspecialchars($row['breed']); ?></small></p>
                    <img src="../uploads/<?php echo htmlspecialchars($row['pet_photo']); ?>" alt="Pet Photo">
                </div>
            </div>
        <?php endwhile; ?>
    <?php else: ?>
        <p>No pets found.</p>
    <?php endif; ?>

    <!-- Add Pet Card -->
    <div class="card add-card" onclick="openModal()">
        <div>
            <img src="path_to_icon.png" alt="Add Icon" style="width:50px;margin-top:30px;">
            <p>Add A Pet Profile</p>
        </div>
    </div>
</div>

<!-- Add Pet Modal -->
<div id="addPetModal" class="modal">
  <div class="modal-content">
    <span class="close" onclick="closeModal()">&times;</span>
    <h3>Add A New Pet</h3>
    <form action="addpet.php" method="POST" enctype="multipart/form-data">
        <label>Pet Nickname:</label>
        <input type="text" name="pet_nickname" required>

        <label>Pet Full Name:</label>
        <input type="text" name="pet_name" required>

        <label>Birthday:</label>
        <input type="date" name="birthday" required>

        <label>Gender:</label>
        <select name="gender" required>
            <option value="">Select gender</option>
            <option value="Male">Male</option>
            <option value="Female">Female</option>
        </select>

        <label>Breed:</label>
        <input type="text" name="breed" required>

        <label>Color:</label>
        <input type="text" name="color" required>

        <label>Pet Photo:</label>
        <input type="file" name="pet_photo" accept="image/*" required>

        <button type="submit">Save Pet</button>
    </form>
  </div>
</div>

<!-- View Pet Modal -->
<div id="viewPetModal" class="modal">
  <div class="modal-content">
    <span class="close" onclick="closeViewModal()">&times;</span>
    <h3 id="viewPetNickname"></h3>
    <img id="viewPetImage" src="" alt="Pet Photo" style="width:100%;max-width:300px;">
    <p><b>Full Name:</b> <span id="viewPetName"></span></p>
    <p><b>Birthday:</b> <span id="viewPetBirthday"></span></p>
    <p><b>Gender:</b> <span id="viewPetGender"></span></p>
    <p><b>Breed:</b> <span id="viewPetBreed"></span></p>
    <p><b>Color:</b> <span id="viewPetColor"></span></p>

    <div style="margin-top: 20px;">
        <button onclick="editPet()" style="background-color: #4CAF50; color: white; padding: 10px;">Edit</button>
        <button onclick="deletePet()" style="background-color: #f44336; color: white; padding: 10px;">Delete</button>
    </div>
  </div>
</div>

<script>
let currentPetNickname = "";

function openModal() {
    document.getElementById('addPetModal').style.display = "block";
}
function closeModal() {
    document.getElementById('addPetModal').style.display = "none";
}

function openPetDetails(nickname, fullname, birthday, gender, breed, color, photo) {
    currentPetNickname = nickname;
    document.getElementById('viewPetNickname').innerText = nickname;
    document.getElementById('viewPetName').innerText = fullname;
    document.getElementById('viewPetBirthday').innerText = birthday;
    document.getElementById('viewPetGender').innerText = gender;
    document.getElementById('viewPetBreed').innerText = breed;
    document.getElementById('viewPetColor').innerText = color;
    document.getElementById('viewPetImage').src = photo;
    document.getElementById('viewPetModal').style.display = "block";
}

function closeViewModal() {
    document.getElementById('viewPetModal').style.display = "none";
}

function editPet() {
    window.location.href = 'editpet.php?pet_nickname=' + encodeURIComponent(currentPetNickname);
}

function deletePet() {
    if (confirm("Are you sure you want to delete this pet?")) {
        window.location.href = 'deletepet.php?pet_nickname=' + encodeURIComponent(currentPetNickname);
    }
}

window.onclick = function(event) {
    var addModal = document.getElementById('addPetModal');
    var viewModal = document.getElementById('viewPetModal');
    if (event.target == addModal) {
        addModal.style.display = "none";
    }
    if (event.target == viewModal) {
        viewModal.style.display = "none";
    }
}
</script>

</body>
</html>

<?php
$conn->close();
?>
