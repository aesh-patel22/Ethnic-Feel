<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

$conn = mysqli_connect("localhost", "root", "", "ethnic_store");
if (!$conn) die("Connection failed: " . mysqli_connect_error());

$user_id = $_SESSION['user_id'];

// Fetch user
$stmt = $conn->prepare("SELECT * FROM users WHERE id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$user = $stmt->get_result()->fetch_assoc();
$stmt->close();

// Update Profile
if (isset($_POST['update_profile'])) {
    $firstname = mysqli_real_escape_string($conn, $_POST['firstname']);
    $lastname = mysqli_real_escape_string($conn, $_POST['lastname']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);

    $update = "UPDATE users SET firstname=?, lastname=?, email=?, phone=? WHERE id=?";
    $stmt = $conn->prepare($update);
    $stmt->bind_param("ssssi", $firstname, $lastname, $email, $phone, $user_id);
    if ($stmt->execute()) {
        $_SESSION['firstname'] = $firstname;
        $msg = "<div class='msg success'>Profile updated!</div>";
    } else {
        $msg = "<div class='msg error'>Update failed.</div>";
    }
    $stmt->close();
}

// CHANGE PASSWORD
if (isset($_POST['change_password'])) {
    $old_pass = $_POST['old_password'];
    $new_pass = $_POST['new_password'];
    $confirm_pass = $_POST['confirm_password'];

    if (!password_verify($old_pass, $user['password'])) {
        $msg = "<div class='msg error'>Current password is incorrect.</div>";
    } elseif ($new_pass !== $confirm_pass) {
        $msg = "<div class='msg error'>New passwords do not match.</div>";
    } elseif (strlen($new_pass) < 6) {
        $msg = "<div class='msg error'>Password must be 6+ characters.</div>";
    } else {
        $new_hashed = password_hash($new_pass, PASSWORD_DEFAULT);
        $update_pass = "UPDATE users SET password=? WHERE id=?";
        $stmt = $conn->prepare($update_pass);
        $stmt->bind_param("si", $new_hashed, $user_id);
        if ($stmt->execute()) {
            $msg = "<div class='msg success'>Password changed successfully!</div>";
        } else {
            $msg = "<div class='msg error'>Failed to update password.</div>";
        }
        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>My Account - ETHNIC FEEL</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/lucide@latest/dist/umd/lucide.min.js"></script>
<link rel="stylesheet" href="homestyle.css">
<style>
    body { 
        margin: 0; 
        background: Beige; 
        font-family: 'Inter', sans-serif;
        padding-top: 140px;
    }
    @media (max-width: 768px) {
        body { padding-top: 180px; }
    }
    .profile-wrapper { 
        max-width: 1200px; 
        margin: 0 auto; 
        padding: 0 20px; 
        display: flex; 
        gap: 25px; 
        flex-wrap: wrap; 
    }
    .sidebar { 
        flex: 1; 
        min-width: 240px; 
        background: Beige; 
        padding: 20px; 
        border-radius: 12px; 
        box-shadow: 0 2px 10px rgba(0,0,0,0.08); 
    }
    .main-content { 
        flex: 3; 
        min-width: 300px; 
    }
    .card { 
        background: Beige; 
        padding: 25px; 
        border-radius: 12px; 
        box-shadow: 0 2px 10px rgba(0,0,0,0.08); 
        margin-bottom: 20px; 
    }
    .card h3 { 
        color: #D62F65; 
        margin: 0 0 15px; 
        padding-bottom: 8px; 
        border-bottom: 2px solid Beige; 
        font-size: 18px; 
    }
    .nav-item { 
        padding: 12px 15px; 
        margin: 6px 0; 
        border-radius: 8px; 
        cursor: pointer; 
        transition: 0.3s; 
        display: flex; 
        align-items: center; 
        font-size: 15px; 
    }
    .nav-item:hover, .nav-item.active { 
        background: #D62F65; 
        color: #fff; 
    }
    .nav-item i { 
        width: 18px; 
        height: 18px; 
        margin-right: 10px; 
    }
    input, select { 
        width: 100%; 
        padding: 11px; 
        margin: 8px 0; 
        border: 1px solid #ddd; 
        border-radius: 8px; 
        font-size: 14px; 
    }
    button { 
        background: #D62F65; 
        color: #fff; 
        border: none; 
        padding: 11px 20px; 
        border-radius: 8px; 
        cursor: pointer; 
        font-weight: 600; 
        margin-top: 10px; 
    }
    button:hover { background: #b71c4a; }
    table { 
        width: 100%; 
        border-collapse: collapse; 
        margin-top: 15px; 
        font-size: 14px; 
    }
    th, td { 
        border: 1px solid #eee; 
        padding: 10px; 
        text-align: left; 
    }
    th { background: #f8f9fa; font-weight: 600; }
    .status { 
        padding: 4px 10px; 
        border-radius: 20px; 
        font-size: 11px; 
        font-weight: 600; 
        text-transform: uppercase; 
    }
    .status.pending { background: #fff3cd; color: #856404; }
    .status.shipped { background: #d4edda; color: #155724; }
    .status.delivered { background: #d1ecf1; color: #0c5460; }
    .status.cancelled { background: #ffcdd2; color: #f44336; }
    .msg { 
        padding: 10px; 
        margin: 10px 0; 
        border-radius: 8px; 
        font-size: 14px; 
        font-weight: 500; 
    }
    .success { background: #d4edda; color: #155724; }
    .error { background: #f8d7da; color: #721c24; }
    hr { border: none; border-top: 1px solid #eee; margin: 25px 0; }
    .logout-link { 
        color: #D62F65; 
        text-decoration: none; 
        font-weight: 600; 
        margin-top: 25px; 
        display: inline-block; 
    }
    .product-col {
        display: flex;
        align-items: center;
        gap: 15px;
    }
    .product-col img {
        width: 70px;
        height: 90px;
        object-fit: cover;
        border-radius: 6px;
        border: 1px solid #eee;
    }
    .product-details {
        display: flex;
        flex-direction: column;
        gap: 3px;
    }
    .product-details strong {
        color: #D62F65;
        font-weight: 600;
        font-size: 14px;
    }
    .product-details span {
        font-size: 13px;
        color: #555;
    }
    .action-btn {
        display: inline-block;
        padding: 6px 12px;
        margin-right: 8px;
        border-radius: 4px;
        font-weight: 600;
        text-decoration: none;
        transition: opacity 0.3s;
        text-align: center;
        border: 1px solid #D62F65;
        background-color: #D62F65;
        color: #ffffff !important;
    }
    .action-btn:hover { opacity: 0.8; }
    td.action-column {
        display: flex;
        gap: 8px;
        align-items: center;
        justify-content: center;
        padding: 10px;
    }
</style>
</head>
<body>

<?php include 'header.php'; ?>

<div class="profile-wrapper">

    <!-- LEFT SIDEBAR -->
    <div class="sidebar">
        <div class="nav-item active" onclick="showSection('account')">
            <i data-lucide="user"></i> Account Settings
        </div>
        <div class="nav-item" onclick="showSection('orders')">
            <i data-lucide="package"></i> My Orders
        </div>
        <a href="index.php" class="logout-link">
            <i data-lucide="log-out"></i> Logout
        </a>
    </div>

    <!-- RIGHT CONTENT -->
    <div class="main-content">

        <!-- ACCOUNT SETTINGS -->
        <div id="account" class="card">
            <h3>Account Settings</h3>
            <?php if (isset($msg)) echo $msg; ?>

            <form method="POST">
                <input type="text" name="firstname" value="<?= htmlspecialchars($user['firstname']) ?>" placeholder="First Name" required>
                <input type="text" name="lastname" value="<?= htmlspecialchars($user['lastname']) ?>" placeholder="Last Name" required>
                <input type="email" name="email" value="<?= htmlspecialchars($user['email']) ?>" placeholder="Email" required>
                <input type="text" name="phone" value="<?= htmlspecialchars($user['phone']) ?>" placeholder="Phone" required>
                <button type="submit" name="update_profile">Update Profile</button>
            </form>

            <hr>

            <h3>Change Password</h3>
            <form method="POST">
                <input type="password" name="old_password" required placeholder="Current Password">
                <input type="password" name="new_password" required minlength="6" placeholder="New Password">
                <input type="password" name="confirm_password" required minlength="6" placeholder="Confirm New Password">
                <button type="submit" name="change_password">Change Password</button>
            </form>
        </div>

        <!-- MY ORDERS -->
        <div id="orders" class="card" style="display:none;">
            <h3>My Orders</h3>
            <?php
            $stmt = $conn->prepare("SELECT * FROM orders WHERE user_id = ? ORDER BY order_date DESC");
            $stmt->bind_param("i", $user_id);
            $stmt->execute();
            $orders = $stmt->get_result();

            if ($orders->num_rows > 0) {
                echo "<table>
                        <tr><th>Product Details</th><th>Date</th><th>Total Price</th><th>Status</th><th>Action</th></tr>";

                while ($o = $orders->fetch_assoc()) {
                    // SAFE IMAGE PATH
                    $filename = basename($o['product_image']);
                    $image_path = "uploads/" . $filename;
                    $final_image = file_exists($image_path) ? $image_path : "uploads/placeholder.jpg";

                    $status = strtolower($o['status'] ?? 'pending');
                    $total_price = $o['product_price'] ?? 0;
                    $can_cancel = ($status === 'pending');

                    echo "<tr>
                            <td>
                                <div class='product-col'>
                                    <img src=\"" . htmlspecialchars($final_image) . "\" alt=\"" . htmlspecialchars($o['product_name']) . "\">
                                    <div class='product-details'>
                                        <strong>" . htmlspecialchars($o['product_name']) . "</strong>
                                        <span>Size: " . htmlspecialchars($o['size'] ?? 'N/A') . "</span>
                                    </div>
                                </div>
                            </td>
                            <td>" . date('d M Y', strtotime($o['order_date'] ?? 'now')) . "</td>
                            <td>₹" . number_format($total_price) . "</td>
                            <td><span class='status $status'>" . ucfirst($status) . "</span></td>
                            <td class='action-column'>
                                <a href='order_details.php?id={$o['order_id']}' class='action-btn view'>View</a>";
                                if ($can_cancel) {
                                    echo "<a href='cancel_order.php?id={$o['order_id']}' 
                                            class='action-btn cancel' 
                                            onclick=\"return confirm('Cancel Order #{$o['order_id']}?');\">
                                            Cancel
                                          </a>";
                                }
                    echo "      </td>
                          </tr>";
                }
                echo "</table>";
            } else {
                echo "<p>No orders yet.</p>";
            }
            $stmt->close();
            ?>
        </div>

    </div>
</div>

<script>
    lucide.createIcons();

    function showSection(section) {
        document.querySelectorAll('.card').forEach(c => c.style.display = 'none');
        document.getElementById(section).style.display = 'block';
        document.querySelectorAll('.nav-item').forEach(n => n.classList.remove('active'));
        const navItem = document.querySelector(`.nav-item[onclick="showSection('${section}')"]`);
        if (navItem) navItem.classList.add('active');
    }

    // Auto-open section from URL
    const urlParams = new URLSearchParams(window.location.search);
    const initialSection = urlParams.get('section') || 'account';
    showSection(initialSection);
</script>

</body>
</html>

<?php $conn->close(); ?>