<?php
session_start();
// 1. Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

// 2. Database connection
$conn = mysqli_connect("localhost", "root", "", "ethnic_store");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$user_id = $_SESSION['user_id'];
$order_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// 3. Validate Order ID
if ($order_id <= 0) {
    // If order ID is missing or invalid, redirect with an error message
    header("Location: profile.php?section=orders&msg=error_invalid_order");
    exit();
}

// 4. Check Ownership and Status
// We use a SELECT query first to ensure:
// A) The order belongs to the current user ($user_id).
// B) The order is still in the 'Pending' status (assuming only pending orders can be canceled).

$stmt_check = $conn->prepare("SELECT status FROM orders WHERE order_id = ? AND user_id = ?");
$stmt_check->bind_param("ii", $order_id, $user_id);
$stmt_check->execute();
$result_check = $stmt_check->get_result();

if ($result_check->num_rows === 0) {
    // Order not found or does not belong to the user
    header("Location: profile.php?section=orders&msg=error_unauthorized");
    exit();
}

$order_data = $result_check->fetch_assoc();
$order_status = strtolower($order_data['status']);

if ($order_status !== 'pending') {
    // Cannot cancel if status is not Pending
    header("Location: profile.php?section=orders&msg=error_not_pending");
    exit();
}


// 5. Delete the Order
$stmt_delete = $conn->prepare("DELETE FROM orders WHERE order_id = ? AND user_id = ?");
$stmt_delete->bind_param("ii", $order_id, $user_id);

if ($stmt_delete->execute()) {
    // Successful deletion
    header("Location: profile.php?section=orders&msg=success_cancelled");
} else {
    // Deletion failed
    header("Location: profile.php?section=orders&msg=error_db_fail");
}

$conn->close();
exit();
?>