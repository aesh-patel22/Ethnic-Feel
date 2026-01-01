<?php
session_start();
include 'db.php'; // Connect to the database

// Check for a valid database connection
if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}

// Check if a product ID is provided in the URL
if (!isset($_GET['id']) ) {
    die("A valid product ID was not provided.");
}

$product_id = intval($_GET['id']); // Sanitize the ID to ensure it's an integer

// Fetch the specific product from the database using a procedural query
$sql = "SELECT * FROM products WHERE id = $product_id";
$result = mysqli_query($conn, $sql);

// Check if the query executed successfully
if (!$result) {
    die("Database query failed: " . mysqli_error($conn));
}

$product = null;

// Check if the query returned exactly one product
if (mysqli_num_rows($result) == 1) {
    $product = mysqli_fetch_assoc($result);
}

// If no product was found with that ID, stop the script
if ($product === null) {
    die("Product not found with ID: " . htmlspecialchars($product_id));
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($product['name']); ?> - Ethnic Feel</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Inter font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #fdfaf6; /* A soft off-white background */
        }
        /* Style for the collapsible details section */
        details > summary {
            list-style: none; /* Remove default marker */
            cursor: pointer;
        }
        details > summary::-webkit-details-marker {
            display: none; /* Remove default marker for Chrome */
        }
        details[open] summary .plus-icon {
            transform: rotate(45deg);
        }
        .plus-icon {
            transition: transform 0.3s ease-in-out;
        }
    </style>
</head>
<body class="text-gray-800">

<?php include 'header.php'; ?>

<div class="container mx-auto px-4 py-8 mt-24">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
        <!-- Left Column: Product Image -->
        <div>
            <img src="uploads/<?php echo htmlspecialchars($product['image']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>" class="w-full h-auto object-cover rounded-lg shadow-md">
        </div>

        <!-- Right Column: Product Details -->
        <div>
            <p class="text-sm uppercase tracking-widest text-gray-500">MENSWEAR</p>
            <h1 class="text-3xl md:text-4xl font-bold mt-2"><?php echo htmlspecialchars($product['name']); ?></h1>
            
            <p class="text-3xl text-[#D62F65] font-semibold mt-4">
                INR <?php echo number_format($product['price']); ?>
            </p>
            <p class="text-xs text-gray-500 mt-1">All taxes are included in MRP. Shipping and Duties calculated at checkout.</p>

            <!-- Size Selection -->
            <div class="mt-6">
                <p class="font-semibold mb-2">SIZE</p>
                <div class="flex space-x-2">
                    <button class="w-12 h-12 border border-black text-black font-semibold rounded-md">S</button>
                    <button class="w-12 h-12 border border-gray-300 text-gray-400 rounded-md">M</button>
                    <button class="w-12 h-12 border border-gray-300 text-gray-400 rounded-md">L</button>
                    <button class="w-12 h-12 border border-gray-300 text-gray-400 rounded-md">XL</button>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="mt-8 flex flex-col space-y-3">
                <button class="w-full bg-gray-200 text-black py-3 font-semibold rounded-md hover:bg-gray-300 transition">ADD TO CART</button>
                <button class="w-full bg-gray-800 text-white py-3 font-semibold rounded-md hover:bg-black transition">BUY IT NOW</button>
                <a href="https://wa.me/?text=I'm%20interested%20in%20the%20product:%20<?php echo urlencode($product['name']); ?>" target="_blank" class="w-full bg-green-500 text-white text-center py-3 font-semibold rounded-md hover:bg-green-600 transition">ORDER VIA WHATSAPP</a>
            </div>

            <!-- Collapsible Details Sections -->
            <div class="mt-8 border-t border-gray-200">
                <details class="py-4 border-b border-gray-200">
                    <summary class="flex justify-between items-center font-semibold">
                        PRODUCT DETAILS
                        <span class="plus-icon text-xl">+</span>
                    </summary>
                    <div class="pt-2 text-gray-600">
                        <?php echo nl2br(htmlspecialchars($product['description'])); ?>
                    </div>
                </details>
                <details class="py-4 border-b border-gray-200">
                    <summary class="flex justify-between items-center font-semibold">
                        CARE & GUIDE
                        <span class="plus-icon text-xl">+</span>
                    </summary>
                    <div class="pt-2 text-gray-600">
                        <p>Dry clean only.</p>
                    </div>
                </details>
                 <details class="py-4 border-b border-gray-200">
                    <summary class="flex justify-between items-center font-semibold">
                        MANUFACTURER'S DETAILS
                        <span class="plus-icon text-xl">+</span>
                    </summary>
                    <div class="pt-2 text-gray-600">
                        <p><strong>Manufactured and Packed By:</strong><br>
                        Address: Goodview Fashion Pvt Ltd<br>
                        708, Pace City II, Sec 37, Phase II, Gurugram, Haryana - 122004</p>
                    </div>
                </details>
            </div>
        </div>
    </div>
</div>

</body>
</html>
