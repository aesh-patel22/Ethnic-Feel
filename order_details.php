<?php
session_start();
// Security Check: Ensure user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php"); // Redirect to login/home page
    exit();
}

$conn = mysqli_connect("localhost", "root", "", "ethnic_store");
if (!$conn) die("Connection failed: " . mysqli_connect_error());

$user_id = $_SESSION['user_id'];
$order_id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$order = null;

if ($order_id > 0) {
    // SECURITY: Select the order AND verify it belongs to the logged-in user
    $stmt = $conn->prepare("SELECT * FROM orders WHERE order_id = ? AND user_id = ?");
    $stmt->bind_param("ii", $order_id, $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $order = $result->fetch_assoc();
    }
    $stmt->close();
}

// Handle case where order is not found or doesn't belong to user
if (!$order) {
    // Set a flag or redirect to the profile orders section
    header("Location: profile.php?section=orders&error=notfound");
    exit();
}

// Prepare Data for Display
$status = strtolower($order['status'] ?? 'pending');
$total_price = $order['product_price'] ?? ($order['total_amount'] ?? 0); 
$order_date = date('d M Y, h:i A', strtotime($order['order_date'] ?? time()));

// Build Image Path
$filename = basename(trim($order['product_image']));
$image_path = "uploads/" . $filename;
$final_image = file_exists($image_path) ? $image_path : "uploads/placeholder.jpg";

// Assemble Shipping Address
$shipping_address = implode(', ', array_filter([
    $order['address_line1'],
    $order['address_line2'],
    $order['city'],
    $order['state'],
    $order['pincode'],
    $order['country']
]));

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Order #<?= $order_id ?> Details – ETHNIC FEEL</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background: #FFF8E7; /* Beige/light theme color */
            padding: 40px 20px;
            margin: 0;
            line-height: 1.6;
        }
        .container {
            max-width: 900px;
            margin: auto;
            background: #ffffff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 6px 20px rgba(0,0,0,0.08);
        }
        h1 {
            color: #D62F65;
            border-bottom: 2px solid #F3E5AB; /* Light Beige border */
            padding-bottom: 15px;
            margin-bottom: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        h2 {
            color: #D62F65;
            margin-top: 30px;
            margin-bottom: 15px;
            font-size: 1.3rem;
            border-left: 4px solid #D62F65;
            padding-left: 10px;
        }
        .order-summary {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin-bottom: 20px;
            background: #fdf6f6;
            padding: 20px;
            border-radius: 8px;
        }
        .summary-item strong {
            display: block;
            font-weight: 600;
            color: #333;
            margin-bottom: 3px;
        }
        .summary-item span {
            color: #D62F65;
            font-weight: 700;
        }
        .status {
            padding: 6px 10px;
            border-radius: 20px;
            font-weight: 600;
            font-size: 0.9rem;
            display: inline-block;
        }
        .status.pending { background: #ffe0b2; color: #ff9800; }
        .status.shipped { background: #bbdefb; color: #2196f3; }
        .status.delivered { background: #c8e6c9; color: #4caf50; }
        .status.cancelled { background: #ffcdd2; color: #f44336; }

        /* Product Section */
        .product-card {
            display: flex;
            gap: 20px;
            align-items: center;
            border: 1px solid #eee;
            padding: 15px;
            border-radius: 8px;
        }
        .product-card img {
            width: 120px;
            height: 160px;
            object-fit: cover;
            border-radius: 6px;
        }
        .product-info {
            flex-grow: 1;
        }
        .product-info p {
            margin: 5px 0;
            font-size: 1rem;
        }
        .product-info .name {
            font-size: 1.4rem;
            font-weight: 700;
            color: #D62F65;
            margin-bottom: 10px;
        }
        .product-info .price {
            font-size: 1.2rem;
            font-weight: 600;
            color: #333;
        }
        .product-info .detail-label {
             font-weight: 500;
             color: #666;
             width: 60px;
             display: inline-block;
        }

        /* Address Section */
        .address-card {
            padding: 15px;
            border: 1px solid #D62F65;
            border-radius: 8px;
            background: #FFFAEC; /* Lighter Beige for contrast */
        }
        .address-card p {
            margin: 0;
        }
        .address-card strong {
            color: #D62F65;
            font-weight: 600;
            display: block;
            margin-bottom: 5px;
        }
        .address-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }
        
        .back-link {
            display: inline-block;
            margin-top: 20px;
            color: #D62F65;
            font-weight: 600;
            text-decoration: none;
        }
        .back-link:hover {
            text-decoration: underline;
        }

        @media (max-width: 600px) {
            .order-summary, .address-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>

<div class="container">
    <h1>
        Order #<?= $order_id ?>
        <a href="profile.php?section=orders" class="back-link" style="margin:0;">
            ← Back to Orders
        </a>
    </h1>

    <!-- Order Status & Date Summary -->
    <div class="order-summary">
        <div class="summary-item">
            <strong>Order Date</strong>
            <?= $order_date ?>
        </div>
        <div class="summary-item">
            <strong>Order Status</strong>
            <span class="status <?= $status ?>"><?= ucfirst($status) ?></span>
        </div>
        <div class="summary-item">
            <strong>Payment Status</strong>
            <!-- Assuming status is always 'Paid' for simplicity, adjust if necessary -->
            <span style="color:#4caf50; font-weight:700;">Paid</span>
        </div>
        <div class="summary-item">
            <strong>Order Total</strong>
            <span>₹<?= number_format($total_price) ?></span>
        </div>
    </div>
    
    <!-- Product Details -->
    <h2>Product Purchased</h2>
    <div class="product-card">
        <img src="<?= $final_image ?>" alt="<?= htmlspecialchars($order['product_name']) ?>" onerror="this.onerror=null;this.src='uploads/placeholder.jpg';">
        <div class="product-info">
            <div class="name"><?= htmlspecialchars($order['product_name']) ?></div>
            <p class="price">₹<?= number_format($total_price) ?></p>
            <p><span class="detail-label">Size:</span> <?= htmlspecialchars($order['size'] ?? 'N/A') ?></p>
            <p><span class="detail-label">Qty:</span> 1</p>
        </div>
    </div>
    
    <!-- Shipping and Customer Details -->
    <h2>Shipping Information</h2>
    <div class="address-grid">
        <div class="address-card">
            <strong>Shipping Address</strong>
            <p><?= htmlspecialchars($order['customer_name']) ?></p>
            <p><?= htmlspecialchars($order['address_line1']) ?></p>
            <p><?= htmlspecialchars($order['address_line2']) ?></p>
            <p><?= htmlspecialchars($order['city']) . ", " . htmlspecialchars($order['state']) ?></p>
            <p><?= htmlspecialchars($order['country']) . " - " . htmlspecialchars($order['pincode']) ?></p>
        </div>
        
        <div class="address-card">
            <strong>Contact Details</strong>
            <p><span class="detail-label">Name:</span> <?= htmlspecialchars($order['customer_name']) ?></p>
            <p><span class="detail-label">Email:</span> <?= htmlspecialchars($order['email']) ?></p>
            <p><span class="detail-label">Phone:</span> <?= htmlspecialchars($order['phone']) ?></p>
        </div>
    </div>

    <a href="profile.php?section=orders" class="back-link">
        ← Return to My Orders
    </a>

</div>

</body>
</html>