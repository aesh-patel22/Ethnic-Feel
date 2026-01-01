<?php
session_start();
$message = "";

// Check if the login form was submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    // --------------------------------------------------------
    // *** IMPORTANT: REPLACE THIS WITH YOUR REAL DATABASE CHECK ***
    // --------------------------------------------------------
    // This is a dummy check for demonstration. 
    // In a real application, you would:
    // 1. Connect to the database.
    // 2. Safely query the 'admins' or 'users' table using prepared statements.
    // 3. Verify the hashed password.

    if ($username === 'admin' && $password === 'admin123') {
        // SUCCESS: Set the session variable that dashboard.php checks
        $_SESSION['admin_id'] = 1; // Use the actual admin's ID from your database
        $_SESSION['admin_username'] = $username;
        
        // Redirect to the dashboard
        header('Location: dashboard.php');
        exit();
    } else {
        $message = "Invalid username or password.";
    }
}

// If the user is already logged in, redirect them away from the login page
if (isset($_SESSION['admin_id'])) {
    header('Location: dashboard.php');
    exit();
}

// Database connection
$conn = mysqli_connect("localhost", "root", "", "ethnic_store");
if (!$conn) { die("Connection failed: " . mysqli_connect_error()); }

$update_msg = '';

/* -------------------------------------------------
    HANDLE STATUS UPDATE (New block added)
    ------------------------------------------------- */
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['order_id']) && isset($_POST['new_status'])) {
    $order_id = intval($_POST['order_id']);
    $new_status = trim($_POST['new_status']);

    // Validate status to prevent SQL injection or invalid data
    $allowed_statuses = ['approved', 'shipped', 'delivered'];
    if (in_array($new_status, $allowed_statuses) && $order_id > 0) {
        // Use prepared statement for secure update
        $stmt = $conn->prepare("UPDATE orders SET status = ? WHERE order_id = ?");
        $stmt->bind_param("si", $new_status, $order_id);

        if ($stmt->execute()) {
            $update_msg = "<div class='msg success'>Order #{$order_id} status updated to " . ucfirst($new_status) . ".</div>";
        } else {
            $update_msg = "<div class='msg error'>Error updating order #{$order_id}: " . htmlspecialchars($stmt->error) . "</div>";
        }
        $stmt->close();
    } else {
        $update_msg = "<div class='msg error'>Invalid status or Order ID provided.</div>";
    }
}
/* -------------------------------------------------
   PRODUCT ADD / UPDATE / DELETE – MUST BE AT TOP
   ------------------------------------------------- */
if (isset($_GET['view']) && $_GET['view'] == "product") {

    // ---------- ADD ----------
    if (isset($_POST['add_product'])) {
        $pname = mysqli_real_escape_string($conn, $_POST['name']);
        $price = floatval($_POST['price']);
        $subcat = intval($_POST['subcategory_id']);
        $imgName = $_FILES['image']['name'];
        $tmpName = $_FILES['image']['tmp_name'];
        if (!is_dir("uploads")) mkdir("uploads");
        $target = "uploads/".basename($imgName);

        if (move_uploaded_file($tmpName, $target) && $pname && $price>0 && $subcat>0) {
            $ins = "INSERT INTO products (name, image, price, subcategory_id)
                    VALUES ('$pname', '$imgName', $price, $subcat)";
            if (mysqli_query($conn, $ins)) {
                header("Location: dashboard.php?view=product&success=1");
                exit;
            }
        }
    }

    // ---------- UPDATE ----------
    if (isset($_POST['update_product'])) {
        $pid   = intval($_POST['pid']);
        $pname = mysqli_real_escape_string($conn, $_POST['name']);
        $price = floatval($_POST['price']);
        $sub   = intval($_POST['subcategory_id']);

        if (!empty($_FILES['image']['name'])) {
            $target = "uploads/".basename($_FILES['image']['name']);
            move_uploaded_file($_FILES['image']['tmp_name'], $target);
            $img = basename($_FILES['image']['name']);
            mysqli_query($conn, "UPDATE products SET name='$pname', price=$price,
                                 image='$img', subcategory_id=$sub WHERE id=$pid");
        } else {
            mysqli_query($conn, "UPDATE products SET name='$pname', price=$price,
                                 subcategory_id=$sub WHERE id=$pid");
        }
        header("Location: dashboard.php?view=product&updated=1");
        exit;
    }

    // ---------- DELETE ----------
    if (isset($_GET['delete_product'])) {
        $pid = intval($_GET['delete_product']);
        mysqli_query($conn, "DELETE FROM products WHERE id=$pid");
        header("Location: dashboard.php?view=product&deleted=1");
        exit;
    }
}
/* -------------------------------------------------
   SUBCATEGORY ADD / DELETE – MUST BE AT TOP
   ------------------------------------------------- */
if (isset($_GET['view']) && $_GET['view'] == "subcategory") {

    // ---------- ADD SUBCATEGORY ----------
    if (isset($_POST['add_subcategory'])) {
        $sname = mysqli_real_escape_string($conn, $_POST['name']);
        $cat_id = intval($_POST['category_id']);
        if ($sname && $cat_id) {
            $ins = "INSERT INTO subcategories (category_id, sub_name) VALUES ($cat_id, '$sname')";
            if (mysqli_query($conn, $ins)) {
                $redir = $selected_cat_id ? "dashboard.php?view=subcategory&cat_id=$selected_cat_id&success=1"
                                          : "dashboard.php?view=subcategory&success=1";
                header("Location: $redir");
                exit;
            } else {
                $error = mysqli_error($conn);
            }
        }
    }

    // ---------- DELETE SUBCATEGORY ----------
    if (isset($_GET['delete_subcat'])) {
        $sid = intval($_GET['delete_subcat']);
        if (mysqli_query($conn, "DELETE FROM subcategories WHERE id=$sid")) {
            $redir = $selected_cat_id ? "dashboard.php?view=subcategory&cat_id=$selected_cat_id&deleted=1"
                                      : "dashboard.php?view=subcategory&deleted=1";
            header("Location: $redir");
            exit;
        } else {
            $error = mysqli_error($conn);
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body { margin:0; font-family:Arial,sans-serif; background:#F5F5DC; }
        .navbar { background:#D62F65; padding:15px; display:flex; justify-content:space-between; color:#fff; }
        .navbar a { color:white; text-decoration:none; margin:0 15px; font-weight:bold; }
        .navbar a:hover { text-decoration:underline; }
        .content { padding:20px; }
        h2,h3 { color:#D62F65; }
        table { width:100%; border-collapse:collapse; margin-top:15px; background:#fff; }
        th,td { border:1px solid #ccc; padding:12px; text-align:left; }
        th { background:#D62F65; color:#fff; }
        form { margin-top:15px; background:#fff; padding:15px; border-radius:8px; }
        input,select { padding:8px; margin:5px 0; border:1px solid #ccc; border-radius:4px; width:calc(100% - 10px); box-sizing:border-box; }
        button[type="submit"] { background:#D62F65; color:#fff; padding:10px 20px; border:none; border-radius:4px; cursor:pointer; margin-top:10px; font-weight:bold; }
        button[type="submit"]:hover { background:#b91c50; }
        .link-button { display:inline-block; background:#D62F65; color:#fff; padding:8px 15px; border-radius:4px; text-decoration:none; margin:10px 0; font-weight:bold; }
        .link-button:hover { background:#b91c50; }
        
        /* Product List Styling */
        .product-list-img { width: 50px; height: auto; border-radius: 4px; }

        /* --- New Order Management Styles --- */
        .product-img { width: 50px; height: 80px; object-fit: cover; border-radius: 4px; display: block; margin: auto; }
            
        /* Status Display */
        .status { padding: 5px 10px; border-radius: 4px; font-weight: 500; text-transform: capitalize; text-align: center; font-size: 13px;}
        .pending { background-color: beige; color: #856404; }
        .approved { background-color: #d4edda; color: #155724; }
        .shipped { background-color: #d1ecf1; color: #0c5460; }
        .delivered { background-color: #c3e6cb; color: #0f5132; }
        
        /* Action Buttons - MODIFIED FOR HORIZONTAL LAYOUT */
        .actions-cell { 
            white-space: nowrap; 
            display: flex; /* Use Flexbox for horizontal layout */
            gap: 4px; /* Space between buttons */
            align-items: center; 
        }
        .actions-cell form {
            margin: 0; /* Remove form margin when inside the flex container */
        }
        .action-button { 
            background: #D62F65; 
            color: white; 
            border: none; 
            padding: 6px 10px; 
            margin: 0; /* Remove previous margins that caused stacking */
            border-radius: 4px; 
            cursor: pointer; 
            font-size: 12px;
            font-weight: 600;
            transition: background-color 0.2s;
            /* width: 100%; and display: block; removed */
            flex-shrink: 0;
            line-height: 1.2; /* Better button text alignment */
        }
        .action-button:hover {
            background: #b91c50; 
        }
        .action-button:disabled {
            background: #ccc;
            cursor: not-allowed;
            opacity: 0.7;
        }
                .btn-delete, .btn-check {
    background-color: #d62f65;
    color: white;
    padding: 8px 14px;
    text-decoration: none;
    border-radius: 6px;
    font-size: 13px;
    font-weight: 600;
    display: inline-block;
    transition: background 0.3s ease;
    margin-right: 8px;
}

.btn-delete:hover, .btn-check:hover {
    background-color: #b91c50;
}

        /* Utility Messages */
        .msg { padding: 12px; margin: 15px 0; border-radius: 6px; font-weight: 500; text-align: center; }
        .success { background: #d4edda; color: #155724; }
        .error { background: #f8d7da; color: #721c24; }
    </style>
</head>
<body>
   <div class="navbar">
    <div>
        <a href="dashboard.php">Dashboard</a>
        <a href="dashboard.php?view=category">Category</a>
        <a href="dashboard.php?view=subcategory">Sub Category</a>
        <a href="dashboard.php?view=product">Product</a>
        <a href="dashboard.php?view=order">Order Summary</a>
    </div>
    <a href="logout.php">Logout</a>
</div>
        
    </div>
   <div class="content">
<?php
/* --------------------------------------------------------------
   CATEGORY SECTION
-------------------------------------------------------------- */
if (isset($_GET['view']) && $_GET['view'] == "category") {
    echo "<h2>Manage Categories</h2>";

    // Add
    if (isset($_POST['add_category'])) {
        $name = mysqli_real_escape_string($conn, $_POST['name']);
        if ($name) mysqli_query($conn, "INSERT INTO categories (cat_name) VALUES ('$name')");
    }

    // Delete
    if (isset($_GET['delete_cat'])) {
        $id = intval($_GET['delete_cat']);
        mysqli_query($conn, "DELETE FROM categories WHERE id=$id");
    }

    // List
    $res = mysqli_query($conn, "SELECT * FROM categories ORDER BY cat_name");
    echo "<table><tr><th>ID</th><th>Name</th><th>Action</th></tr>";
    while ($row = mysqli_fetch_assoc($res)) {
        echo "<tr>
                <td>{$row['id']}</td>
                <td>" . htmlspecialchars($row['cat_name']) . "</td>
              <td>
    <a href='dashboard.php?view=category&delete_cat={$row['id']}' 
       onclick='return confirm(\"Delete this category?\")' 
       class='btn-delete'>Delete</a>

    <a href='dashboard.php?view=subcategory&cat_id={$row['id']}' 
       class='btn-check'>Check it</a>
</td>
              </tr>";
    }
    echo "</table>";

    // Add form
    echo "<form method='POST'>
            <h3>Add Category</h3>
            <input type='text' name='name' placeholder='Category Name' required>
            <button type='submit' name='add_category'>Add</button>
          </form>";
}

/* --------------------------------------------------------------
   SUBCATEGORY SECTION
-------------------------------------------------------------- */
elseif (isset($_GET['view']) && $_GET['view'] == "subcategory") {
    echo "<h2>Manage Subcategories</h2>";

    $selected_cat_id = isset($_GET['cat_id']) ? intval($_GET['cat_id']) : 0;
    $cat_name = "";
    if ($selected_cat_id) {
        $cres = mysqli_query($conn, "SELECT cat_name FROM categories WHERE id=$selected_cat_id");
        if ($crow = mysqli_fetch_assoc($cres)) {
            $cat_name = htmlspecialchars($crow['cat_name']);
            echo "<h3>Subcategories under: <strong>$cat_name</strong>
                  <a href='dashboard.php?view=subcategory'  class='btn-delete'>View SubCategories</a>
                  <a href='dashboard.php?view=category'  class='btn-delete'>Back to Categories</a>
                  </h3>";
        }
    } else {
        echo "<a href='dashboard.php?view=category'  class='btn-delete'>Back to Categories</a>";
    }

    // Add
    if (isset($_POST['add_subcategory'])) {
        $sname = mysqli_real_escape_string($conn, $_POST['name']);
        $cat_id = intval($_POST['category_id']);
        if ($sname && $cat_id) {
            $ins = "INSERT INTO subcategories (category_id, sub_name) VALUES ($cat_id, '$sname')";
            if (mysqli_query($conn, $ins)) {
                $redir = $selected_cat_id ? "dashboard.php?view=subcategory&cat_id=$selected_cat_id&success=1"
                                          : "dashboard.php?view=subcategory&success=1";
                header("Location: $redir"); exit;
            } else {
                $error = mysqli_error($conn);
            }
        }
    }

    // Delete
    if (isset($_GET['delete_subcat'])) {
        $sid = intval($_GET['delete_subcat']);
        if (mysqli_query($conn, "DELETE FROM subcategories WHERE id=$sid")) {
            $redir = $selected_cat_id ? "dashboard.php?view=subcategory&cat_id=$selected_cat_id&deleted=1"
                                      : "dashboard.php?view=subcategory&deleted=1";
            header("Location: $redir"); exit;
        } else {
            $error = mysqli_error($conn);
        }
    }

    // Messages
    if (isset($_GET['success'])) echo "<div class='msg success'>Subcategory added successfully!</div>";
    if (isset($_GET['deleted'])) echo "<div class='msg warning'>Subcategory deleted.</div>";
    if (isset($_GET['error']))   echo "<div class='msg error'>Error: ".htmlspecialchars($_GET['error'])."</div>";
    if (isset($error))          echo "<div class='msg error'>Error: ".htmlspecialchars($error)."</div>";

    // List subcategories
    $sql = "SELECT s.id, s.sub_name, c.cat_name
            FROM subcategories s
            JOIN categories c ON s.category_id = c.id";
    if ($selected_cat_id) $sql .= " WHERE s.category_id = $selected_cat_id";
    $sql .= " ORDER BY c.cat_name, s.sub_name";

    $res = mysqli_query($conn, $sql);
    echo "<table><tr><th>ID</th><th>Subcategory</th><th>Category</th><th>Action</th></tr>";
    if (mysqli_num_rows($res)) {
        while ($row = mysqli_fetch_assoc($res)) {
    $sid = $row['id'];
    $sname = htmlspecialchars($row['sub_name']);
    $cname = htmlspecialchars($row['cat_name']);

    // Build URLs with cat_id if available
    $deleteUrl = "dashboard.php?view=subcategory&delete_subcat=$sid";
    $viewProductsUrl = "dashboard.php?view=subcategory&view_products=$sid";
    if ($selected_cat_id) {
        $deleteUrl .= "&cat_id=$selected_cat_id";
        $viewProductsUrl .= "&cat_id=$selected_cat_id";
    }

    echo "<tr>
            <td>$sid</td>
            <td>$sname</td>
            <td>$cname</td>
            <td>
                <a href='" . htmlspecialchars($deleteUrl) . "'
                   class='btn-delete'
                   onclick='return confirm(\"Delete this subcategory?\")'>
                   Delete
                </a>
                <a href='" . htmlspecialchars($viewProductsUrl) . "'
                   class='btn-check'>
                   View Products
                </a>
            </td>
          </tr>";
        }
    } else {
        echo "<tr><td colspan='4'>No subcategories found.</td></tr>";
    }
    echo "</table>";

   // View products of a sub-category
// View products of a sub-category
if (isset($_GET['view_products'])) {
    $sid = intval($_GET['view_products']);
    $cat_id_param = $selected_cat_id ? "&cat_id=$selected_cat_id" : "";
    $backUrl = "dashboard.php?view=subcategory" . $cat_id_param;

    $snRes = mysqli_query($conn, "SELECT sub_name FROM subcategories WHERE id=$sid");
    $subRow = mysqli_fetch_assoc($snRes);
    $subName = $subRow ? htmlspecialchars($subRow['sub_name']) : 'Unknown';

    echo "<h3>Products under Subcategory: <strong>$subName</strong>
          <a href='$backUrl' class='btn-delete'>Back</a></h3>";

    $pRes = mysqli_query($conn, "SELECT * FROM products WHERE subcategory_id=$sid");
    if (mysqli_num_rows($pRes)) {
        echo "<table><tr><th>ID</th><th>Name</th><th>Image</th><th>Price</th></tr>";
        while ($p = mysqli_fetch_assoc($pRes)) {
            $imgFile = basename(trim($p['image']));
            $imgPath = "uploads/" . $imgFile;
            if (!file_exists($imgPath) || $imgFile == "") {
                $imgPath = "uploads/placeholder.jpg";
            }

            echo "<tr>
                    <td>{$p['id']}</td>
                    <td>" . htmlspecialchars($p['name']) . "</td>
                    <td><img src='$imgPath' width='60' height='60'
                         style='object-fit:cover; border-radius:4px; border:1px solid #ccc;'></td>
                    <td>₹" . number_format($p['price'], 0, '', ',') . "</td>
                  </tr>";
        }
        echo "</table>";
    } else {
        echo "<p>No products found.</p>";
    }
}

    // Add form
    echo "<form method='POST' style='margin-top:20px'>
            <h3>Add Subcategory</h3>
            <input type='text' name='name' placeholder='Subcategory Name' required><br><br>";
    $catRes = mysqli_query($conn, "SELECT * FROM categories ORDER BY cat_name");
    echo "<select name='category_id' required>
            <option value=''>-- Select Category --</option>";
    while ($c = mysqli_fetch_assoc($catRes)) {
        $sel = ($selected_cat_id == $c['id']) ? "selected" : "";
        echo "<option value='{$c['id']}' $sel>" . htmlspecialchars($c['cat_name']) . "</option>";
    }
    echo "</select><br><br>
          <button type='submit' name='add_subcategory'>Add</button>
          </form>";
}

/* --------------------------------------------------------------
   PRODUCT SECTION  (IMAGE NOW VISIBLE)
-------------------------------------------------------------- */
elseif (isset($_GET['view']) && $_GET['view'] == "product") {
    echo "<h2>Manage Products</h2>";

    // ---------- ADD ----------
    if (isset($_POST['add_product'])) {
        $pname = mysqli_real_escape_string($conn, $_POST['name']);
        $price = floatval($_POST['price']);
        $subcat = intval($_POST['subcategory_id']);
        $imgName = $_FILES['image']['name'];
        $tmpName = $_FILES['image']['tmp_name'];
        if (!is_dir("uploads")) mkdir("uploads");
        $target = "uploads/".basename($imgName);

        if (move_uploaded_file($tmpName, $target) && $pname && $price>0 && $subcat>0) {
            $ins = "INSERT INTO products (name, image, price, subcategory_id)
                    VALUES ('$pname', '$imgName', $price, $subcat)";
            if (mysqli_query($conn, $ins)) {
                header("Location: dashboard.php?view=product&success=1"); exit;
            }
        }
    }

    // ---------- UPDATE ----------
    if (isset($_POST['update_product'])) {
        $pid   = intval($_POST['pid']);
        $pname = mysqli_real_escape_string($conn, $_POST['name']);
        $price = floatval($_POST['price']);
        $sub   = intval($_POST['subcategory_id']);

        if (!empty($_FILES['image']['name'])) {
            $target = "uploads/".basename($_FILES['image']['name']);
            move_uploaded_file($_FILES['image']['tmp_name'], $target);
            $img = basename($_FILES['image']['name']);
            mysqli_query($conn, "UPDATE products SET name='$pname', price=$price,
                                 image='$img', subcategory_id=$sub WHERE id=$pid");
        } else {
            mysqli_query($conn, "UPDATE products SET name='$pname', price=$price,
                                 subcategory_id=$sub WHERE id=$pid");
        }
        header("Location: dashboard.php?view=product&updated=1"); exit;
    }

    // ---------- DELETE ----------
    if (isset($_GET['delete_product'])) {
        $pid = intval($_GET['delete_product']);
        mysqli_query($conn, "DELETE FROM products WHERE id=$pid");
        header("Location: dashboard.php?view=product&deleted=1"); exit;
    }

    // ---------- MESSAGES ----------
    if (isset($_GET['success'])) echo "<div class='msg success'>Product added!</div>";
    if (isset($_GET['updated'])) echo "<div class='msg success'>Product updated!</div>";
    if (isset($_GET['deleted'])) echo "<div class='msg warning'>Product deleted.</div>";

    // ---------- EDIT FORM ----------
    if (isset($_GET['edit_product'])) {
        $pid = intval($_GET['edit_product']);
        $edit = mysqli_query($conn, "SELECT * FROM products WHERE id=$pid");
        $p = mysqli_fetch_assoc($edit);

        echo "<form method='POST' enctype='multipart/form-data'>
                <h3>Update Product</h3>
                <input type='hidden' name='pid' value='{$p['id']}'>
                <input type='text' name='name' value='".htmlspecialchars($p['name'])."' required><br><br>
                <input type='number' step='0.01' name='price' value='{$p['price']}' required><br><br>
                <input type='file' name='image'><br><br>
                <select name='subcategory_id' required>";
        $subRes = mysqli_query($conn, "SELECT s.id, s.sub_name, c.cat_name
                                       FROM subcategories s
                                       JOIN categories c ON s.category_id=c.id");
        while ($s = mysqli_fetch_assoc($subRes)) {
            $sel = ($s['id']==$p['subcategory_id']) ? "selected" : "";
            echo "<option value='{$s['id']}' $sel>{$s['sub_name']} ({$s['cat_name']})</option>";
        }
        echo "</select><br><br>
              <button type='submit' name='update_product'>Update</button>
              </form>";
    }

   /* ---------- PRODUCT LIST (WITH IMAGE) ---------- */
$sql = "SELECT p.id, p.name, p.image, p.price, s.sub_name AS subcategory, c.cat_name AS category
        FROM products p
        JOIN subcategories s ON p.subcategory_id = s.id
        JOIN categories c ON s.category_id = c.id
        ORDER BY p.id DESC";
$res = mysqli_query($conn, $sql);

echo "<table><tr>
        <th>ID</th><th>Name</th><th>Image</th><th>Price</th>
        <th>Subcategory</th><th>Category</th><th>Action</th>
      </tr>";

while ($row = mysqli_fetch_assoc($res)) {

    // remove path if database has full path stored
    $imgFile = basename(trim($row['image']));
    $imgPath = "uploads/" . $imgFile;

    // check if file exists else show placeholder
    if(!file_exists($imgPath) || $imgFile == "") {
        $imgPath = "uploads/placeholder.jpg";
    }

    echo "<tr>
            <td>{$row['id']}</td>
            <td>" . htmlspecialchars($row['name']) . "</td>
            <td style='text-align:center;'>
                <img src='$imgPath' width='80' height='80'
                    style='object-fit:cover;border-radius:6px;border:1px solid #ddd;'>
            </td>
            <td>" . number_format($row['price'], 0, '', ',') . "</td>
            <td>{$row['subcategory']}</td>
            <td>{$row['category']}</td>
            <td>
              <a href='dashboard.php?view=product&edit_product={$row['id']}' 
   class='btn-delete'>Edit</a>

<a href='dashboard.php?view=product&delete_product={$row['id']}' 
   onclick='return confirm('Delete this product?')' 
   class='btn-delete'>Delete</a>
            </td>
          </tr>";
}
echo "</table>";

    // ---------- ADD FORM ----------
    echo "<form method='POST' enctype='multipart/form-data' style='margin-top:20px'>
            <h3>Add Product</h3>
            <input type='text' name='name' placeholder='Product Name' required><br><br>
            <input type='file' name='image' required><br><br>
            <input type='number' step='0.01' name='price' placeholder='Price' required><br><br>
            <select name='subcategory_id' required>
                <option value=''>-- Select Subcategory --</option>";
    $subRes = mysqli_query($conn, "SELECT s.id, s.sub_name, c.cat_name
                                   FROM subcategories s
                                   JOIN categories c ON s.category_id=c.id");
    while ($s = mysqli_fetch_assoc($subRes)) {
        echo "<option value='{$s['id']}'>{$s['sub_name']} ({$s['cat_name']})</option>";
    }
    echo "</select><br><br>
          <button type='submit' name='add_product'>Add</button>
          </form>";
}
/* --------------------------------------------------------------
    ORDER SUMMARY (NEW ENHANCED LOGIC)
-------------------------------------------------------------- */
elseif (isset($_GET['view']) && $_GET['view'] == "order") {

    echo "<h2>Order Summary & Management</h2>";
    echo $update_msg; // Display update message here

    /* -------------------------------------------------
        FETCH ORDERS
        ------------------------------------------------- */
    $orders_query = "
        SELECT 
            order_id, 
            product_id, 
            product_image, 
            product_name, 
            product_price, 
            size, 
            customer_name, 
            email, 
            phone, 
            city, 
            order_date, 
            status
        FROM orders 
        ORDER BY order_id DESC
    ";
    $res = mysqli_query($conn, $orders_query);
    
    if (mysqli_num_rows($res)) {
        echo "<table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Product Name</th>
                        <th>Image</th>
                        <th>Size</th>
                        <th>Price</th>
                        <th>Customer</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>City</th>
                        <th>Order Date</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>";
        
        while ($row = mysqli_fetch_assoc($res)) {
            $display_image = htmlspecialchars($row['product_image']);
            $current_status = strtolower($row['status']);

            echo "<tr>
                    <td>{$row['order_id']}</td>
                    <td>" . htmlspecialchars($row['product_name']) . "</td>
                    <td><img src=\"{$display_image}\" alt=\"Product\" class=\"product-img\" onerror=\"this.onerror=null;this.src='https://placehold.co/50x70/E0E0E0/333?text=N/A';\"></td>
                    <td>" . htmlspecialchars($row['size']) . "</td>
                    <td>₹" . number_format($row['product_price']) . "</td>
                    <td>" . htmlspecialchars($row['customer_name']) . "</td>
                    <td>" . htmlspecialchars($row['email']) . "</td>
                    <td>" . htmlspecialchars($row['phone']) . "</td>
                    <td>" . htmlspecialchars($row['city']) . "</td>
                    <td>" . date('Y-m-d', strtotime($row['order_date'])) . "</td>
                    <td class=\"status " . $current_status . "\">" . htmlspecialchars($row['status']) . "</td>
                    <td class=\"actions-cell\">";

                        // Only show buttons if the status hasn't reached 'delivered'
                        if ($current_status !== 'delivered') { 
                            
                            // Approve Button - Removed style="display:block;"
                            echo "<form method=\"POST\">
                                <input type=\"hidden\" name=\"order_id\" value=\"{$row['order_id']}\">
                                <input type=\"hidden\" name=\"new_status\" value=\"approved\">
                                <button type=\"submit\" class=\"action-button\" title=\"Set status to Approved\"" . 
                                ($current_status === 'approved' ? ' disabled' : '') . ">
                                    Approve
                                </button>
                            </form>";
                            
                            // Ship Button - Removed style="display:block;"
                            echo "<form method=\"POST\">
                                <input type=\"hidden\" name=\"order_id\" value=\"{$row['order_id']}\">
                                <input type=\"hidden\" name=\"new_status\" value=\"shipped\">
                                <button type=\"submit\" class=\"action-button\" title=\"Set status to Shipped\"" . 
                                ($current_status === 'shipped' ? ' disabled' : '') . ">
                                    Ship
                                </button>
                            </form>";
                            
                            // Deliver Button - Removed style="display:block;"
                            echo "<form method=\"POST\">
                                <input type=\"hidden\" name=\"order_id\" value=\"{$row['order_id']}\">
                                <input type=\"hidden\" name=\"new_status\" value=\"delivered\">
                                <button type=\"submit\" class=\"action-button\" title=\"Set status to Delivered\">
                                    Deliver
                                </button>
                            </form>";
                        } else {
                            echo "<span style=\"color:#155724; font-weight: 600; padding: 6px 0; display: block;\">Delivered</span>";
                        }
                    echo "</td>
                </tr>";
        }
        echo "</tbody></table>";
    } else {
        echo "<p>No orders found.</p>";
    }
}

/* --------------------------------------------------------------
    DEFAULT WELCOME
-------------------------------------------------------------- */
else {
    echo "<h2>Welcome to Admin Dashboard</h2><p>Select a link from the navigation bar to manage categories, products, or orders.</p>";
    include 'das.php';
}
//  
?>
    </div>
</body>
</html>