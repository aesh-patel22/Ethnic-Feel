<?php
session_start();
include 'db.php';
include 'header.php';

// ---------- USER ID ----------
$user_id = $_SESSION['user_id'] ?? 'guest_' . session_id();

// ---------- ADD TO CART (from product page) ----------
if (isset($_POST['action']) && $_POST['action'] === 'add') {
    $product_id = (int)$_POST['id'];
    $size       = $_POST['size'] ?? 'ONE SIZE';
    $gender     = $_POST['gender'] ?? 'N/A';
    $quantity   = 1;

    // Get price
    $price_stmt = mysqli_prepare($conn, "SELECT price FROM products WHERE id = ?");
    mysqli_stmt_bind_param($price_stmt, "i", $product_id);
    mysqli_stmt_execute($price_stmt);
    $price_result = mysqli_stmt_get_result($price_stmt);
    $price_row = mysqli_fetch_assoc($price_result);
    $price = $price_row['price'] ?? 0;

    if ($price == 0) {
        $error = "Product not found.";
    } else {
        // Check if exists
        $check = mysqli_prepare($conn,
            "SELECT item_id, quantity FROM cart 
             WHERE user_id = ? AND product_id = ? AND size_label = ? AND gender_type = ?");
        mysqli_stmt_bind_param($check, "siss", $user_id, $product_id, $size, $gender);
        mysqli_stmt_execute($check);
        $res = mysqli_stmt_get_result($check);

        if (mysqli_num_rows($res) > 0) {
            $row = mysqli_fetch_assoc($res);
            $new_qty = $row['quantity'] + 1;
            $upd = mysqli_prepare($conn, "UPDATE cart SET quantity = ? WHERE item_id = ?");
            mysqli_stmt_bind_param($upd, "ii", $new_qty, $row['item_id']);
            mysqli_stmt_execute($upd);
            $success = "Quantity updated!";
        } else {
            $ins = mysqli_prepare($conn,
                "INSERT INTO cart 
                 (user_id, product_id, quantity, item_price, size_label, gender_type, status)
                 VALUES (?, ?, ?, ?, ?, ?, 'CART')");
            mysqli_stmt_bind_param($ins, "siidss", $user_id, $product_id, $quantity, $price, $size, $gender);
            if (mysqli_stmt_execute($ins)) {
                $success = "Added to cart!";
            } else {
                $error = "Failed to add: " . mysqli_error($conn);
            }
        }
    }
}

// ---------- REMOVE ITEM ----------
if (isset($_GET['remove'])) {
    $item_id = (int)$_GET['remove'];
    $del = mysqli_prepare($conn, "DELETE FROM cart WHERE item_id = ? AND user_id = ?");
    mysqli_stmt_bind_param($del, "is", $item_id, $user_id);
    mysqli_stmt_execute($del);
    $success = "Item removed.";
    
}

// ---------- UPDATE QUANTITY ----------
if (isset($_POST['update_qty'])) {
    $item_id  = (int)$_POST['item_id'];
    $qty      = max(1, (int)$_POST['quantity']);
    $upd = mysqli_prepare($conn, "UPDATE cart SET quantity = ? WHERE item_id = ? AND user_id = ?");
    mysqli_stmt_bind_param($upd, "iis", $qty, $item_id, $user_id);
    mysqli_stmt_execute($upd);
    
}

// ---------- FETCH CART ITEMS ----------
$cart_items = [];
$stmt = mysqli_prepare($conn,
    "SELECT c.*, p.name, p.image 
     FROM cart c 
     JOIN products p ON c.product_id = p.id 
     WHERE c.user_id = ? AND c.status = 'CART'");
mysqli_stmt_bind_param($stmt, "s", $user_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

while ($row = mysqli_fetch_assoc($result)) {
    $row['subtotal'] = $row['quantity'] * $row['item_price'];
    $cart_items[] = $row;
}
$total = array_sum(array_column($cart_items, 'subtotal'));
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Cart</title>
    <style>
        body { font-family: 'Inter', sans-serif; background: #f5f5dc; margin: 0; padding: 20px; }
.container {
    max-width: 1000px;
    margin: 120px auto 40px;   /* ← was 40px → now 120px */
    background: white;
    padding: 30px;
    border-radius: 12px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.1);
}        h1 { font-size: 28px; color: #1f2937; text-transform: uppercase; margin-bottom: 20px; }
        table { width: 100%; border-collapse: collapse; margin: 20px 0; }
        th, td { padding: 15px; text-align: left; border-bottom: 1px solid #eee; }
        th { background: #f9fafb; font-weight: 600; text-transform: uppercase; font-size: 12px; color: #6b7280; }
        .product-img { width: 70px; height: 90px; object-fit: cover; border-radius: 6px; }
        .qty-input { width: 60px; padding: 8px; text-align: center; border: 1px solid #ddd; border-radius: 4px; }
        .remove-btn { color: #dc2626; font-weight: 600; text-decoration: underline; cursor: pointer; }
        .total { font-size: 24px; font-weight: bold; color: #D62F65; text-align: right; margin: 20px 0; }
        .checkout-btn { display: block; width: 100%; padding: 16px; background: #d62f65; color: white; text-align: center; font-weight: bold; text-transform: uppercase; border: none; border-radius: 6px; cursor: pointer; font-size: 16px; text-decoration: none; }
        .empty { text-align: center; color: #666; font-size: 18px; padding: 40px; }
        .alert { padding: 15px; border-radius: 6px; margin: 20px 0; }
        .success { background: #d4edda; color: #155724; }
        .error { background: #f8d7da; color: #721c24; }
        .size-gender { font-size: 13px; color: #666; }
    </style>
</head>
<body>
<div class="container">
    <h1>Your Cart</h1>

    <?php if (isset($success)): ?>
        <div class="alert success"><?php echo htmlspecialchars($success); ?></div>
    <?php endif; ?>
    <?php if (isset($error)): ?>
        <div class="alert error"><?php echo htmlspecialchars($error); ?></div>
    <?php endif; ?>

    <?php if (empty($cart_items)): ?>
        <p class="empty">Your cart is empty. <a href="home.php">Continue Shopping</a></p>
    <?php else: ?>
        <table>
            <tr>
                <th>Product</th>
                <th>Size / Gender</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Subtotal</th>
                <th>Action</th>
            </tr>
            <?php foreach ($cart_items as $item): ?>
            <tr>
                <td>
                    <img src="<?php echo htmlspecialchars($item['image'] ?: 'https://placehold.co/70x90?text=Img'); ?>" 
                         alt="" class="product-img" 
                         onerror="this.src='https://placehold.co/70x90?text=Img'">
                    <strong><?php echo htmlspecialchars($item['name']); ?></strong>
                </td>
                <td class="size-gender">
                    <?php echo htmlspecialchars($item['size_label']); ?>
                    <?php if ($item['gender_type'] !== 'N/A'): ?>
                        <br><small>(<?php echo ucfirst($item['gender_type']); ?>)</small>
                    <?php endif; ?>
                </td>
                <td>INR <?php echo number_format($item['item_price']); ?></td>
                <td>
                    <form method="post" style="display:inline;">
                        <input type="hidden" name="update_qty" value="1">
                        <input type="hidden" name="item_id" value="<?php echo $item['item_id']; ?>">
                        <input type="number" name="quantity" value="<?php echo $item['quantity']; ?>" 
                               min="1" class="qty-input" onchange="this.form.submit()">
                    </form>
                </td>
                <td>INR <?php echo number_format($item['subtotal']); ?></td>
                <td>
                    <a href="cart.php?remove=<?php echo $item['item_id']; ?>" 
                       class="remove-btn" onclick="return confirm('Remove this item?')">
                       Remove
                    </a>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>

        <div class="total">Total: INR <?php echo number_format($total); ?></div>
        <?php if (!empty($cart_items)): ?>
    <form method="post" action="buy_form.php">
        <?php foreach ($cart_items as $item): ?>
            <input type="hidden" name="items[<?php echo $item['item_id']; ?>][id]" value="<?php echo $item['product_id']; ?>">
            <input type="hidden" name="items[<?php echo $item['item_id']; ?>][name]" value="<?php echo htmlspecialchars($item['name']); ?>">
            <input type="hidden" name="items[<?php echo $item['item_id']; ?>][image]" value="<?php echo htmlspecialchars($item['image']); ?>">
            <input type="hidden" name="items[<?php echo $item['item_id']; ?>][price]" value="<?php echo $item['item_price']; ?>">
            <input type="hidden" name="items[<?php echo $item['item_id']; ?>][size]" value="<?php echo htmlspecialchars($item['size_label']); ?>">
            <input type="hidden" name="items[<?php echo $item['item_id']; ?>][qty]" value="<?php echo $item['quantity']; ?>">
        <?php endforeach; ?>
        <button type="submit" class="checkout-btn">PROCEED TO CHECKOUT</button>
    </form>
<?php endif; ?>
    <?php endif; ?>
</div>
</body>
</html>