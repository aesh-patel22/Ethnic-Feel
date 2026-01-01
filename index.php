<?php
// Start session to manage user state and display messages
session_start();

// Determine which form should be active. Default to 'login'.
$active_form = $_SESSION['active_form'] ?? 'login';
unset($_SESSION['active_form']); // Unset after reading
?>
<?php
// Hardcoded static login (username: admin, password: admin123)
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['email'];
    $password = $_POST['password'];

    if ($username === "admin@gmail.com" && $password === "admin123") {
        $_SESSION['admin'] = true;
        header("Location: dashboard.php");
        exit();
    } else {
        $error = "Invalid login details!";
    }
}?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AMU - Account</title>
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700&display=swap" rel="stylesheet">
</head>
<body>
    <div class="container">
        <!-- Left Panel: Brand Information -->
        <div class="left-panel">
            <div class="brand-content">
                <h1 class="logo">Etnic Feel</h1>
                <p class="tagline">Where culture meets Couture</p>
            </div>
        </div>

        <!-- Right Panel: Form Area -->
        <div class="right-panel">
            <div class="form-container">
                <!-- Tab buttons -->
                <div class="tab-buttons">
                    <button class="tab-link <?php echo ($active_form === 'login') ? 'active' : ''; ?>" onclick="showForm('login')">Sign In</button>
                    <button class="tab-link <?php echo ($active_form === 'signup') ? 'active' : ''; ?>" onclick="showForm('signup')">Sign Up</button>
</div>

                <!-- Login Form -->
                <form action="process.php" method="POST" id="loginForm" class="form-content <?php echo ($active_form === 'login') ? 'active' : ''; ?>">
                    <h2>Login to your account</h2>
                    <?php
                    // Display login-specific messages
                    if (isset($_SESSION['login_message'])) {
                        echo '<div class="message">' . $_SESSION['login_message'] . '</div>';
                        unset($_SESSION['login_message']);
                    }
                    ?>
                    <div class="input-group">
                        <label for="login_email">Email</label>
                        <input type="email" id="login_email" name="email" required>
                    </div>
                    <div class="input-group">
                        <label for="login_password">Password</label>
                        <input type="password" id="login_password" name="password" required>
                    </div>
                    <button type="submit" name="login" class="btn-submit">Login</button>
                </form>

                <!-- Signup Form -->
                <form action="process.php" method="POST" id="signupForm" class="form-content <?php echo ($active_form === 'signup') ? 'active' : ''; ?>">
                     <h2>Create an account</h2>
                     <?php
                    // Display signup-specific messages
                    if (isset($_SESSION['signup_message'])) {
                        echo '<div class="message">' . $_SESSION['signup_message'] . '</div>';
                        unset($_SESSION['signup_message']);
                    }
                    ?>
                     <div class="input-group-row">
                        <div class="input-group">
                            <label for="firstname">First Name</label>
                            <input type="text" id="firstname" name="firstname" required>
                        </div>
                        <div class="input-group">
                            <label for="lastname">Last Name</label>
                            <input type="text" id="lastname" name="lastname" required>
                        </div>
                    </div>
                    <div class="input-group">
                        <label for="signup_email">Email</label>
                        <input type="email" id="signup_email" name="email" required>
                    </div>
                     <div class="input-group">
                        <label for="phone">Phone Number</label>
                        <input type="tel" id="phone" name="phone" required>
                    </div>
                    <div class="input-group">
                        <label for="signup_password">Password</label>
                        <input type="password" id="signup_password" name="password" required>
                    </div>
                    <div class="input-group">
                        <label for="conpassword">Confirm Password</label>
                        <input type="password" id="conpassword" name="conpassword" required>
                    </div>
                    <button type="submit" name="signup" class="btn-submit">Create account</button>
                </form>
            </div>
        </div>
    </div>

    <script>
    function showForm(formName) {
        // Handle active state for tab links
        document.querySelectorAll('.tab-link').forEach(button => button.classList.remove('active'));
        document.querySelector(`.tab-link[onclick="showForm('${formName}')"]`).classList.add('active');
        
        // Handle active state for forms
        document.querySelectorAll('.form-content').forEach(form => form.classList.remove('active'));
        document.getElementById(formName + 'Form').classList.add('active');
    }
    </script>
</body>
</html>
