<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    if ($username === "admin" && $password === "admin123") {
        $_SESSION['admin'] = true;
        header("Location: dashboard.php");
        exit();
    } else {
        $error = "Invalid username or password!";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Admin Login - ETHNIC FEEL</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/lucide@latest/dist/umd/lucide.min.js"></script>
  <style>
    * { margin: 0; padding: 0; box-sizing: border-box; }
    body {
      background: #f5f5dc;
      font-family: 'Inter', sans-serif;
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      overflow: hidden;
      position: relative;
    }

    /* Floating Particles */
    .particle {
      position: absolute;
      background: rgba(214, 47, 101, 0.1);
      border-radius: 50%;
      pointer-events: none;
      animation: float 15s infinite ease-in-out;
    }
    .particle:nth-child(1) { width: 60px; height: 60px; top: 20%; left: 15%; animation-delay: 0s; }
    .particle:nth-child(2) { width: 90px; height: 90px; top: 60%; left: 75%; animation-delay: 3s; }
    .particle:nth-child(3) { width: 70px; height: 70px; top: 40%; left: 85%; animation-delay: 6s; }
    .particle:nth-child(4) { width: 50px; height: 50px; top: 80%; left: 10%; animation-delay: 9s; }
    @keyframes float {
      0%, 100% { transform: translateY(0) rotate(0deg); opacity: 0.3; }
      50% { transform: translateY(-40px) rotate(15deg); opacity: 0.7; }
    }

    .container {
      display: flex;
      width: 90%;
      max-width: 1100px;
      background: white;
      border-radius: 24px;
      overflow: hidden;
      box-shadow: 0 20px 60px rgba(0, 0, 0, 0.12);
      animation: slideIn 0.8s ease-out;
    }
    @keyframes slideIn {
      from { opacity: 0; transform: translateY(40px); }
      to { opacity: 1; transform: translateY(0); }
    }

    /* Left Side - TEXT CENTERED */
    .left {
      flex: 1;
      background: #fdf9f0;
      padding: 60px 40px;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      color: #d62f65;
      text-align: center;
    }
    .left h1 {
      font-size: 36px;
      font-weight: 700;
      margin-bottom: 16px;
      color: #d62f65;
    }
    .left p {
      font-size: 16px;
      color: #666;
      margin-bottom: 30px;
      line-height: 1.6;
      max-width: 320px;
    }

    /* Right Side */
    .right {
      flex: 1;
      padding: 60px 50px;
      display: flex;
      flex-direction: column;
      justify-content: center;
    }
    .right h2 {
      color: #d62f65;
      font-size: 28px;
      margin-bottom: 8px;
      font-weight: 600;
    }
    .right p.subtitle {
      color: #666;
      font-size: 15px;
      margin-bottom: 30px;
    }

    /* Icons BESIDE Input */
    .input-row {
      display: flex;
      align-items: center;
      margin-bottom: 24px;
      gap: 12px;
    }
    .input-row i {
      color: #aaa;
      font-size: 20px;
      width: 36px;
      height: 36px;
      display: flex;
      align-items: center;
      justify-content: center;
      transition: color 0.3s;
    }
    .input-row input {
      flex: 1;
      padding: 16px;
      border: 2px solid #eee;
      border-radius: 14px;
      font-size: 15px;
      background: #fafafa;
      transition: all 0.3s;
    }
    .input-row input:focus {
      outline: none;
      border-color: #d62f65;
      background: white;
      box-shadow: 0 0 0 4px rgba(214, 47, 101, 0.12);
    }
    .input-row input:focus + i {
      color: #d62f65;
    }

    button {
      width: 100%;
      padding: 16px;
      background: #d62f65;
      color: white;
      border: none;
      border-radius: 50px;
      font-size: 16px;
      font-weight: 600;
      cursor: pointer;
      transition: all 0.3s;
      position: relative;
      overflow: hidden;
      box-shadow: 0 8px 20px rgba(214, 47, 101, 0.3);
    }
    button::before {
      content: '';
      position: absolute;
      top: 50%;
      left: 50%;
      width: 0;
      height: 0;
      background: rgba(255,255,255,0.2);
      border-radius: 50%;
      transform: translate(-50%, -50%);
      transition: width 0.6s, height 0.6s;
    }
    button:active::before {
      width: 300px;
      height: 300px;
    }
    button:hover {
      background: #b71c4a;
      transform: translateY(-3px);
      box-shadow: 0 12px 28px rgba(214, 47, 101, 0.35);
    }

    .error {
      background: #ffe6e6;
      color: #d62f65;
      padding: 12px;
      border-radius: 10px;
      font-size: 14px;
      margin-top: 15px;
      border: 1px solid #ffd6d6;
      text-align: center;
    }

    .footer {
      margin-top: 30px;
      text-align: center;
      font-size: 13px;
      color: #888;
    }
    .footer a {
      color: #d62f65;
      text-decoration: none;
    }
    .footer a:hover { text-decoration: underline; }

    @media (max-width: 992px) {
      .container { flex-direction: column; }
      .left, .right { padding: 40px; }
      .left { order: 2; }
    }
    @media (max-width: 576px) {
      .right { padding: 30px 25px; }
      h2 { font-size: 24px; }
      .input-row { flex-direction: column; align-items: stretch; }
      .input-row i { width: 100%; justify-content: flex-start; padding-left: 16px; }
    }
  </style>
</head>
<body>

  <!-- Floating Particles -->
  <div class="particle"></div>
  <div class="particle"></div>
  <div class="particle"></div>
  <div class="particle"></div>

  <div class="container">
    <!-- Left: TEXT ONLY, CENTERED -->
    <div class="left">
      <h1>ETHNIC FEEL</h1>
      <p>Secure admin access to manage your store, track orders, and analyze customer insights with elegance.</p>
    </div>

    <!-- Right: Login Form -->
    <div class="right">
      <h2>Admin Portal</h2>
      <p class="subtitle">Login to access the dashboard</p>

      <form method="POST">
        <div class="input-row">
          <i data-lucide="user"></i>
          <input type="text" name="username" placeholder="Username" required>
        </div>
        <div class="input-row">
          <i data-lucide="lock"></i>
          <input type="password" name="password" placeholder="Password" required>
        </div>
        <button type="submit">Login Securely</button>
      </form>

      <?php if (!empty($error)): ?>
        <div class="error"><?php echo htmlspecialchars($error); ?></div>
      <?php endif; ?>

      <div class="footer">
        
        <p><a href="home.php">Back to Store</a></p>
      </div>
    </div>
  </div>

  <script>
    lucide.createIcons();
  </script>
</body>
</html>