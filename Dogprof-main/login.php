<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
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
        <h2>Login</h2>
        <form method="post" action="process/login_process.php">
            <input type="email" name="email" required placeholder="Email"><br>
            <div class="password-container">
                <input type="password" name="Password" id="password" required placeholder="Password"><br>
                <i class="fas fa-eye toggle-password" onclick="togglePasswordVisibility()"></i>
            </div>
            <button type="submit" class="register">Login</button>
        </form>
        <p>Don't have an account? <a href="register.php">Register here</a></p>
    </div>
    <script>
        function togglePasswordVisibility() {
            const passwordField = document.getElementById('password');
            const toggleIcon = document.querySelector('.toggle-password');
            
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
