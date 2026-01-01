<?php
// File: process.php
// --- Handles both Login and Signup ---

session_start();
include 'db.php';

// --- SIGNUP LOGIC ---
if (isset($_POST['signup'])) {
    $firstname = trim($_POST['firstname']);
    $lastname  = trim($_POST['lastname']);
    $email     = trim($_POST['email']);
    $phone     = trim($_POST['phone']);
    $password  = $_POST['password'];
    $conpassword = $_POST['conpassword']; // Get the confirmation password

    // Set the active form for redirection on error
    $_SESSION['active_form'] = 'signup';

    if (empty($firstname) || empty($lastname) || !filter_var($email, FILTER_VALIDATE_EMAIL) || empty($phone) || strlen($password) < 6) {
        $_SESSION['signup_message'] = "Please fill all fields correctly (password must be at least 6 characters).";
    } elseif ($password !== $conpassword) {
        // Check if passwords match
        $_SESSION['signup_message'] = "Passwords do not match.";
    } else {
        $sql = "SELECT id FROM users WHERE email = ?";
        if ($stmt = mysqli_prepare($conn, $sql)) {
            mysqli_stmt_bind_param($stmt, "s", $email);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);

            if (mysqli_stmt_num_rows($stmt) > 0) {
                 $_SESSION['signup_message'] = "This email address is already registered.";
            } else {
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                $insert_sql = "INSERT INTO users (firstname, lastname, email, phone, password) VALUES (?, ?, ?, ?, ?)";
                if ($insert_stmt = mysqli_prepare($conn, $insert_sql)) {
                    mysqli_stmt_bind_param($insert_stmt, "sssss", $firstname, $lastname, $email, $phone, $hashed_password);
                    if (mysqli_stmt_execute($insert_stmt)) {
                        $_SESSION['login_message'] = "Account created successfully! Please log in.";
                        $_SESSION['active_form'] = 'login'; // Switch to login form on success
                    } else {
                        $_SESSION['signup_message'] = "Something went wrong. Please try again.";
                    }
                    mysqli_stmt_close($insert_stmt);
                }
            }
            mysqli_stmt_close($stmt);
        }
    }
    header("Location: index.php");
    exit();
}

// --- LOGIN LOGIC ---
if (isset($_POST['login'])) {
    $email    = trim($_POST['email']);
    $password = $_POST['password'];

    // Set the active form for redirection on error
    $_SESSION['active_form'] = 'login';

    if (empty($email) || empty($password)) {
        $_SESSION['login_message'] = "Email and password are required.";
        header("Location: index.php");
        exit();
    }

    $sql = "SELECT * FROM users WHERE email = ?";
    if ($stmt = mysqli_prepare($conn, $sql)) {
        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if ($user = mysqli_fetch_assoc($result)) {
            if (password_verify($password, $user['password'])) {
                $_SESSION['loggedin'] = true;
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['firstname'] = $user['firstname'];
                unset($_SESSION['active_form']);
                header("Location: home.php");
                exit();
            } else {
                // Incorrect password
                $_SESSION['login_message'] = "The email or password you entered is incorrect.";
            }
        } else {
            // No account found
            $_SESSION['login_message'] = "The email or password you entered is incorrect.";
        }
        mysqli_stmt_close($stmt);
    }
    header("Location: index.php");
    exit();
}
?>