<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ethnic Feel - Product Gallery</title>
    <!-- Tailwind CSS CDN for styling -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Inter font from Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="header.css">
</head>
<body class="bg-beige text-black" style="font-family: 'Inter', sans-serif;">

<?php
include 'db.php'; // Connect to your database
include 'header.php'; // Include your header file

// SQL query to select all products
// Note: The subcategory_id is 26 in this version of the file.
$sql = "SELECT id, name, image, price FROM products where subcategory_id=26 ";
$result = mysqli_query($conn, $sql); // Procedural style query
?>

    <!-- Main container for the product gallery -->
    <div class="mt-32 py-8 px-4 md:px-8">
        
        <!-- Product Grid Container -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 md:gap-8">
            
        <?php
            $count = 0; // counter
            // Check if any products were found
          if (mysqli_num_rows($result) > 0) {

    while($row = mysqli_fetch_assoc($result)) {
        $count++; // increase count
?>
<div class="group">
    <a href="product-detail.php?id=<?php echo htmlspecialchars($row['id']); ?>" class="block">
        <div class="bg-white rounded-xl shadow-lg overflow-hidden relative ">
            <img src="<?php echo htmlspecialchars($row["image"]); ?>"
                 alt="<?php echo htmlspecialchars($row["name"]); ?>" 
                 class="product-image rounded-t-xl group-hover:scale-105">

            <?php if($count <= 4) { ?>
            <!-- NEW ARRIVAL TAG ONLY FOR FIRST 5 -->
            <div class="absolute top-4 left-4 right-4 flex justify-between items-start">
                <span class="bg-[#D62F65] text-white text-xs font-semibold px-2 py-1 rounded-full shadow-md">
                    NEW ARRIVALS
                </span>
            </div>
            <?php } ?>
        </div>

        <div class="mt-4 text-center">
            <h3 class="text-base md:text-lg font-semibold text-gray-800">
                <?php echo htmlspecialchars($row["name"]); ?>
            </h3>
            <span class="text-sm md:text-base font-bold text-[#D62F65]">
                INR <?php echo number_format($row["price"]); ?>
            </span>
        </div>
    </a>
</div>
<?php
    } // while end
} else {
    echo "<p class='col-span-4 text-center'>No products found.</p>";
}
?>

        </div>
    </div>
    <?php
    include 'footer.php';
    ?>
</body>
</html>
