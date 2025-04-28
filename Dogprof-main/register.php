<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <link rel="stylesheet" href="style/loginRegister.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <nav class="nav">
        <a class="logo" href="index.php">PAWKEDEX</a>
        <div><p class="about">About Us</p></div>
        <a href="login.php" class="login-btn">Login</a>
    </nav>
    <div class="container">
        <h2>Sign Up</h2>
        <form name="registerForm" method="post" action="process/register_process.php" onsubmit="return validateForm(event)">
            <input type="text" name="First_Name" required placeholder="First Name"><br>
            <input type="text" name="Last_Name" required placeholder="Last Name"><br>
            <select name="Gender" id="Gender">
                <option value="Male">Male</option>
                <option value="Female">Female</option>
                <option value="Prefer not to say">Prefer not to say</option>
            </select><br>
            <input type="email" name="email" required placeholder="Email"><br>
            <input type="text" name="ContactNum" required placeholder="Contact Number"><br>
            
            <!-- Password Field -->
            <div class="password-container">
                <input type="password" name="Password" id="password" required placeholder="Password"><br>
                <i class="fas fa-eye toggle-password" id="password-eye" onclick="togglePasswordVisibility('password', 'password-eye')"></i>
            </div>

            <!-- Confirm Password Field -->
            <div class="password-container">
                <input type="password" name="Confirm_Password" id="confirm-password" required placeholder="Confirm Password"><br>
                <i class="fas fa-eye toggle-password" id="confirm-password-eye" onclick="togglePasswordVisibility('confirm-password', 'confirm-password-eye')"></i>
            </div>
            
            <button type="submit" class="register">Register</button>
        </form>
        <p>Already have an account? <a href="login.php">Login here</a></p>
    </div>

    <!-- JavaScript at the bottom for validation -->
    <script>
        function validateForm(event) {
            const form = document.forms["registerForm"];
            const password = form["Password"].value;
            const confirmPassword = form["Confirm_Password"].value;

            if (password !== confirmPassword) {
                alert("Passwords do not match!");
                event.preventDefault();
                return false;
            }
            return true;
        }

        function togglePasswordVisibility(inputId, iconId) {
            const passwordField = document.getElementById(inputId);
            const toggleIcon = document.getElementById(iconId);
            
            if (passwordField.type === 'password') {
                passwordField.type = 'text';
                toggleIcon.classList.remove('fa-eye');
                toggleIcon.classList.add('fa-eye-slash');
            } else {
                passwordField.type = 'password';
                toggleIcon.classList.remove('fa-eye-slash');
                toggleIcon.classList.add('fa-eye');
            }
        }
    </script>
</body>
</html>
