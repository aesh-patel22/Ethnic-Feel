<?php
session_start();

// Destroy all session data
session_unset();
session_destroy();

// Optional: Clear cookies if used
if (isset($_COOKIE['user_login'])) {
    setcookie('user_login', '', time() - 3600, '/');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Logging Out - ETHNIC FEEL</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
  <style>
    * { margin: 0; padding: 0; box-sizing: border-box; }
    body {
      background-color: #f5f5dc; /* Beige */
      color: #333;
      font-family: 'Inter', sans-serif;
      height: 100vh;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      text-align: center;
      padding: 20px;
    }
    .logout-container {
      max-width: 500px;
      background: #fff;
      padding: 40px 30px;
      border-radius: 16px;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
      animation: fadeIn 0.6s ease-out;
    }
    .icon {
      width: 80px;
      height: 80px;
      background: #d62f65;
      color: #fff;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      margin: 0 auto 20px;
      font-size: 36px;
    }
    h1 {
      color: #d62f65;
      margin-bottom: 12px;
      font-size: 24px;
    }
    p {
      color: #555;
      margin-bottom: 20px;
      font-size: 16px;
    }
    .btn {
      display: inline-block;
      background: #d62f65;
      color: #fff;
      text-decoration: none;
      padding: 12px 28px;
      border-radius: 8px;
      font-weight: 600;
      transition: background 0.3s;
    }
    .btn:hover {
      background: #b71c4a;
    }
    .countdown {
      font-weight: 600;
      color: #d62f65;
    }

    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(20px); }
      to { opacity: 1; transform: translateY(0); }
    }

    @media (max-width: 480px) {
      .logout-container { padding: 30px 20px; }
      h1 { font-size: 20px; }
    }
  </style>
</head>
<body>

  <div class="logout-container">
    <div class="icon">
      <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
        <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/>
        <polyline points="16 17 21 12 16 7"/>
        <line x1="21" y1="12" x2="9" y2="12"/>
      </svg>
    </div>
    <h1>You're Logged Out!</h1>
    <p>You have been securely logged out of your account.</p>
    <p>Redirecting to admin login in <span class="countdown">3</span> seconds...</p>
    <a href="adminlogin.php" class="btn">Go to Admin Login</a>
  </div>

  <script>
    let timeLeft = 3;
    const countdownEl = document.querySelector('.countdown');

    const timer = setInterval(() => {
      timeLeft--;
      countdownEl.textContent = timeLeft;

      if (timeLeft <= 0) {
        clearInterval(timer);
        window.location.href = 'adminlogin.php';
      }
    }, 1000);
  </script>

</body>
</html>