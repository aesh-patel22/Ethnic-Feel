<?php
session_start();
include 'db.php';

// --- USER ID ---
$user_id = $_SESSION['user_id'] ?? 0;

$msg        = '';
$cart_items = [];

// -------------------------------------------------
// 1. GET CART ITEMS FROM POST (from cart.php) — UNCHANGED
// -------------------------------------------------
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['items'])) {
    foreach ($_POST['items'] as $item) {
        $cart_items[] = [
            'product_id' => (int)($item['id'] ?? 0),
            'name'       => htmlspecialchars($item['name'] ?? 'Unknown'),
            'image'      => htmlspecialchars($item['image'] ?? 'placeholder.jpg'),
            'price'      => (float)($item['price'] ?? 0),
            'size'       => htmlspecialchars($item['size'] ?? 'N/A'),
            'quantity'   => (int)($item['qty'] ?? 1),
        ];
    }
// -------------------------------------------------
// NEW: HANDLE SINGLE PRODUCT FROM GET (from product-detail.php "Buy Now")
// -------------------------------------------------
} elseif (isset($_GET['pid'])) {
    $product_id = (int)$_GET['pid'];
    $size = htmlspecialchars($_GET['size'] ?? 'ONE SIZE');

    // Fetch product details from DB
    $stmt = $conn->prepare("SELECT name, price, image FROM products WHERE id = ?");
    if ($stmt) {
        $stmt->bind_param("i", $product_id);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($row = $result->fetch_assoc()) {
            $cart_items[] = [
                'product_id' => $product_id,
                'name'       => htmlspecialchars($row['name']),
                'image'      => htmlspecialchars($row['image']),
                'price'      => (float)$row['price'],
                'size'       => $size,
                'quantity'   => 1  // Default quantity for "Buy Now"
            ];
        } else {
            $msg = "<div class='msg error'>Product not found.</div>";
        }
        $stmt->close();
    } else {
        $msg = "<div class='msg error'>Database error: " . htmlspecialchars($conn->error) . "</div>";
    }
}

// -------------------------------------------------
// NEW: REDIRECT ONLY IF NO ITEMS (fallback for invalid access)
// -------------------------------------------------
if (empty($cart_items) && $msg === '') {
    header("Location: cart.php");
    exit;
}

// -------------------------------------------------
// 2. PROCESS ORDER (when form is submitted) — UNCHANGED
// -------------------------------------------------
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['place_order'])) {

    // Escape / sanitize form fields
    $customer_name = mysqli_real_escape_string($conn, $_POST['customer_name']);
    $email         = mysqli_real_escape_string($conn, $_POST['email']);
    $phone         = mysqli_real_escape_string($conn, $_POST['phone']);
    $addr1         = mysqli_real_escape_string($conn, $_POST['address_line1']);
    $addr2         = mysqli_real_escape_string($conn, $_POST['address_line2']);
    $city          = mysqli_real_escape_string($conn, $_POST['city']);
    $state         = mysqli_real_escape_string($conn, $_POST['state']);
    $pincode       = mysqli_real_escape_string($conn, $_POST['pincode']);
    $country       = mysqli_real_escape_string($conn, $_POST['country']);

    $success   = true;
    $order_ids = [];

    foreach ($cart_items as $item) {

        // ---- Extract to REAL variables (required for bind_param) ----
        $pid    = $item['product_id'];
        $pname  = $item['name'];
        $pimage = $item['image'];
        $pprice = $item['price'];
        $psize  = $item['size'];
        $pqty   = $item['quantity'];

        // ---- INSERT ONE ORDER ROW ----
        $sql = "INSERT INTO orders 
                (user_id, product_id, product_name, product_image, product_price, size, quantity,
                 customer_name, email, phone, address_line1, address_line2, city, state, pincode, country, status)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 'pending')";

        $stmt = $conn->prepare($sql);
        if (!$stmt) {
            $success = false;
            $msg     = "<div class='msg error'>Prepare failed: " . htmlspecialchars($conn->error) . "</div>";
            break;
        }

        // 17 placeholders → 17 type chars
        $stmt->bind_param(
            "iissdsisssssssss",   // i i s s d s i s s s s s s s s s s
            $user_id,
            $pid,
            $pname,
            $pimage,
            $pprice,
            $psize,
            $pqty,
            $customer_name,
            $email,
            $phone,
            $addr1,
            $addr2,
            $city,
            $state,
            $pincode,
            $country
        );

        if (!$stmt->execute()) {
            $success = false;
            $msg     = "<div class='msg error'>Error saving order: " . htmlspecialchars($stmt->error) . "</div>";
            $stmt->close();
            break;
        }

        $order_ids[] = $stmt->insert_id;
        $stmt->close();
    }

    // -------------------------------------------------
    // 3. SUCCESS → CLEAR CART & REDIRECT — UNCHANGED
    // -------------------------------------------------
    if ($success) {
        // Use a real variable for the bind
        $cart_user_id = $_SESSION['user_id'] ?? session_id();

        $clear = $conn->prepare("DELETE FROM cart WHERE user_id = ? AND status = 'CART'");
        if ($clear) {
            $clear->bind_param("s", $cart_user_id);
            $clear->execute();
            $clear->close();
        }
        
        // ** NEW CODE TO DISPLAY ORDER ID **
        $order_ids_str = implode(', #', $order_ids);
        $msg = "<div class='order-id-success'>Order Successfully Placed! Your Order ID(s): #{$order_ids_str}</div>";
        $conn->close();
        
        header("Location: profile.php?section=orders&multi_order=1&ids=" . implode(',', $order_ids));
        exit;
    }
}

// -------------------------------------------------
// 4. CALCULATE TOTAL — UNCHANGED
// -------------------------------------------------
$total = 0;
foreach ($cart_items as $item) {
    $total += $item['price'] * $item['quantity'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Checkout – ETHNIC FEEL</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
<style>
    body{font-family:'Inter',sans-serif;background:#FFF8F0;margin:0;padding:20px;}
    .container{max-width:900px;margin:auto;background:beige;padding:30px;border-radius:12px;
               box-shadow:0 4px 20px rgba(0,0,0,.1);}
    h2{color:#D62F65;text-align:center;margin-bottom:20px;}
    .cart-summary{margin-bottom:30px;}
    .cart-item{display:flex;gap:15px;padding:12px 0;border-bottom:1px solid #eee;}
    .cart-item img{width:60px;height:80px;object-fit:cover;border-radius:6px;}
    .cart-item .info{flex:1;}
    .cart-item .price{color:#D62F65;font-weight:600;}
    .total-price{font-size:22px;font-weight:bold;color:#D62F65;text-align:right;margin:20px 0;}
    label{display:block;margin:12px 0 6px;font-weight:500;color:#333;}
    input,select{width:100%;padding:12px;border:1px solid #ddd;border-radius:8px;font-size:15px;}
    .row{display:flex;gap:15px;}
    .row>div{flex:1;}
    button{background:#D62F65;color:#fff;border:none;padding:14px;font-size:16px;
           font-weight:600;border-radius:8px;cursor:pointer;width:100%;margin-top:20px;transition:.3s;}
    button:hover{background:#b91c50;}
    .required{color:#D62F65;}
    .msg{padding:12px;margin:15px 0;border-radius:6px;font-weight:500;text-align:center;}
    .success{background:#d4edda;color:#155724;}
    .error{background:#f8d7da;color:#721c24;}
    .required{color:#D62F65;}
    .msg{padding:12px;margin:15px 0;border-radius:6px;font-weight:500;text-align:center;}
    .success{background:#d4edda;color:#155724;}
    .error{background:#f8d7da;color:#721c24;}
    /* ADD THIS NEW STYLE */
    .order-id-success { 
        color: #D62F65; 
        font-weight: bold; 
        font-size: 18px;
        text-align: center;
        margin-top: -10px; /* Adjust spacing */
        margin-bottom: 20px;
    }
</style>
</head>
<body>

<div class="container">
  <h2>Checkout – Review & Pay</h2>

  <div class="cart-summary">
    <h3>Order Summary (<?= count($cart_items) ?> items)</h3>
    <?php foreach ($cart_items as $item):
        $img_path    = "uploads/" . basename($item['image']);
        $display_img = file_exists($img_path) ? $img_path : "uploads/placeholder.jpg";
    ?>
      <div class="cart-item">
        <img src="<?= htmlspecialchars($display_img) ?>" alt="<?= $item['name'] ?>">
        <div class="info">
          <strong><?= $item['name'] ?></strong><br>
          <small>Size: <?= $item['size'] ?> | Qty: <?= $item['quantity'] ?></small>
        </div>
        <div class="price">₹<?= number_format($item['price'] * $item['quantity']) ?></div>
      </div>
    <?php endforeach; ?>
    <div class="total-price">Total: ₹<?= number_format($total) ?></div>
  </div>

  <?= $msg ?>

  <form method="POST">
    <input type="hidden" name="place_order" value="1">

    <!-- Re-send cart items (safety) -->
    <?php foreach ($cart_items as $i => $item): ?>
        <input type="hidden" name="items[<?= $i ?>][id]"   value="<?= $item['product_id'] ?>">
        <input type="hidden" name="items[<?= $i ?>][name]" value="<?= $item['name'] ?>">
        <input type="hidden" name="items[<?= $i ?>][image]" value="<?= $item['image'] ?>">
        <input type="hidden" name="items[<?= $i ?>][price]" value="<?= $item['price'] ?>">
        <input type="hidden" name="items[<?= $i ?>][size]"  value="<?= $item['size'] ?>">
        <input type="hidden" name="items[<?= $i ?>][qty]"   value="<?= $item['quantity'] ?>">
    <?php endforeach; ?>

    <label>Full Name <span class="required">*</span></label>
    <input type="text" name="customer_name" required placeholder="John Doe">

    <label>Email <span class="required">*</span></label>
    <input type="email" name="email" required placeholder="john@example.com">

    <label>Phone <span class="required">*</span></label>
    <input type="text" name="phone" required placeholder="+91 98765 43210" maxlength="15">

    <label>Address Line 1 <span class="required">*</span></label>
    <input type="text" name="address_line1" required placeholder="123 Main Street">

    <label>Address Line 2 (Optional)</label>
    <input type="text" name="address_line2" placeholder="Apartment, suite, etc.">

    <div class="row">
      <div>
        <label>City <span class="required">*</span></label>
        <input type="text" name="city" required placeholder="Mumbai">
      </div>
      <div>
        <label>State <span class="required">*</span></label>
        <input type="text" name="state" required placeholder="Maharashtra">
      </div>
    </div>

    <div class="row">
      <div>
        <label>Pincode <span class="required">*</span></label>
        <input type="text" name="pincode" required placeholder="400001" maxlength="6">
      </div>
      <div>
        <label>Country</label>
        <input type="text" name="country" value="India" readonly>
      </div>
    </div>

    <button type="submit">PLACE ORDER (₹<?= number_format($total) ?>)</button>
  </form>
</div>

</body>
</html>