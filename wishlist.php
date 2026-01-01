<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ethnic Feel - Wishlist</title>
    <!-- Tailwind CSS for easy styling -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Inter font from Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="header.css">
</head>
<body class="bg-beige text-black">

<?php
include 'db.php'; // Connect to your database
include 'header.php'; // Include your header file

// Start or resume the session
session_start();

// Initialize wishlist array in session if it doesn't exist
if (!isset($_SESSION['wishlist'])) {
    $_SESSION['wishlist'] = array();
}

// Function to remove an item from wishlist
if (isset($_GET['remove_id'])) {
    $remove_id = intval($_GET['remove_id']);
    if (($key = array_search($remove_id, $_SESSION['wishlist'])) !== false) {
        unset($_SESSION['wishlist'][$key]);
        // Reindex the array to avoid gaps
        $_SESSION['wishlist'] = array_values($_SESSION['wishlist']);
    }
    // Redirect to refresh the page
    header("Location: wishlist.php");
    exit();
}
?>

<div class="mt-32 py-8 px-4 md:px-8">
    <h1 class="text-2xl md:text-3xl font-bold text-center text-gray-800">Your Wishlist</h1>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mt-8">
        <?php
        if (!empty($_SESSION['wishlist'])) {
            // Query to get product details for items in wishlist
            $wishlist_ids = implode(',', $_SESSION['wishlist']);
            $sql = "SELECT id, name, image, price FROM products WHERE id IN ($wishlist_ids)";
            $result = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $name = htmlspecialchars($row['name']);
                    $image = htmlspecialchars($row['image']);
                    $price = number_format($row['price']);
        ?>
        <div class="bg-white rounded-xl shadow-lg p-4 text-center">
            <img src="uploads/<?php echo $image; ?>" alt="<?php echo $name; ?>" class="w-full h-48 object-cover rounded-t-xl">
            <h3 class="mt-2 text-lg font-semibold"><?php echo $name; ?></h3>
            <p class="text-[#D62F65] font-bold">INR <?php echo $price; ?></p>
            <a href="wishlist.php?remove_id=<?php echo $row['id']; ?>" class="mt-2 inline-block p-2 bg-red-500 text-white rounded hover:bg-red-600">Remove</a>
        </div>
        <?php
                }
            } else {
                echo "<p class='col-span-full text-center'>No items match your wishlist.</p>";
            }
        } else {
            echo "<p class='col-span-full text-center'>Your wishlist is empty.</p>";
        }
        mysqli_close($conn); // Close database connection
        ?>
    </div>
    <div class="text-center mt-8">
        <a href="saree.php" class="text-[#D62F65] font-semibold hover:underline">Back to Sarees</a>
    </div>
</div>
</body>
</html>