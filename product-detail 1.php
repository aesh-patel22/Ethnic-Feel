<?php
include 'db.php'; 
include 'header.php';
session_start();

$product_id = isset($_GET['id']) ? (int)$_GET['id'] : 53; 

$LEHENGA_SUBCAT_ID = 18; $SAREE_SUBCAT_ID = 19; $GOWN_SUBCAT_ID = 20; $FUSION_WEAR_SUBCAT_ID = 21;
$KURTA_SUBCAT_ID = 12; $SHERWANI_SUBCAT_ID = 16; $WAISTCOAT_SUBCAT_ID = 17;
$HERITAGE_SUBCAT_ID = 25; $CONTEMPORARY_SUBCAT_ID = 26; $WHITE_SUBCAT_ID = 27; $VOWS_SUBCAT_ID = 28;
$BAGS_SUBCAT_ID = 22; $JEWELRY_SUBCAT_ID = 24; $BELT_SUBCAT_ID = 23;

$MENSWEAR_SUBCAT_IDS = [$KURTA_SUBCAT_ID, $SHERWANI_SUBCAT_ID, $WAISTCOAT_SUBCAT_ID];
$NON_APAREL_SUBCAT_IDS = [$BAGS_SUBCAT_ID, $JEWELRY_SUBCAT_ID, $BELT_SUBCAT_ID];
$apparel_category_ids = [1, 2];

$defaults = [
    'id' => $product_id, 'name' => 'AQUA EMBROIDERED EVENING GOWN', 'price' => 255000.00,
    'description' => 'A stunning floor-length embroidered gown perfect for evening events and receptions.',
    'image' => 'images/gown_example.jpg', 'made_to_order_weeks' => '10', 'category_id' => 1,
    'subcategory_id' => $GOWN_SUBCAT_ID, 'bust_size' => '34.5', 'waist_size' => '27.0', 'hip_size' => '37.0',
    'shoulder_size' => '14.5', 'mrp_inclusive_of' => 'Gown | Lining | Dupatta (Optional)',
    'materials' => 'Net, Silk Lining, Crystal work', 'color' => 'Aqua Blue',
    'care_guide' => 'Dry-Clean only, handle with care.', 'model_height' => '5.9"',
    'manufacturer_name' => 'Ethnic Feel Pvt Ltd',
    'manufacturer_address' => "2 Narrotam nagar , new Rander, Surat - 395004",
    'manufacturer_email' => 'ethnicfeel@gmail.com', 'manufacturer_tel' => '+91 9687309751',
    'country_of_origin' => 'India'
];

$product_data = array();
$sql = "SELECT * FROM products WHERE id = $product_id";
$result = isset($conn) ? mysqli_query($conn, $sql) : false; 
if ($result && mysqli_num_rows($result) > 0) {
    $product_data = mysqli_fetch_assoc($result);
} 
$product = array_merge($defaults, $product_data);

$is_vows_apparel = ($product['subcategory_id'] == $VOWS_SUBCAT_ID);
$is_menswear_apparel = ($product['category_id'] == 2) || in_array($product['subcategory_id'], $MENSWEAR_SUBCAT_IDS);
$is_non_apparel = in_array($product['subcategory_id'], $NON_APAREL_SUBCAT_IDS);
$requires_sizing = !$is_non_apparel;

$category_label = 'WOMENSWEAR';
if ($is_vows_apparel) $category_label = 'VOWS & BRIDAL SETS';
elseif ($is_menswear_apparel) $category_label = 'MENSWEAR';
elseif ($is_non_apparel) $category_label = 'ACCESSORIES';

if ($product['subcategory_id'] == $GOWN_SUBCAT_ID) {
    $product['mrp_inclusive_of'] = 'Gown | Lining | Dupatta (Optional)';
} elseif (in_array($product['subcategory_id'], [$LEHENGA_SUBCAT_ID, $HERITAGE_SUBCAT_ID, $WHITE_SUBCAT_ID])) {
    $product['mrp_inclusive_of'] = 'Lehenga | Blouse | Dupatta';
} elseif ($product['subcategory_id'] == $SAREE_SUBCAT_ID) {
    $product['mrp_inclusive_of'] = 'Saree | Blouse ';
} elseif ($product['subcategory_id'] == $FUSION_WEAR_SUBCAT_ID) {
    $product['mrp_inclusive_of'] = 'Top | Bottoms | Styling Accessories (as applicable)';
} elseif ($product['subcategory_id'] == $KURTA_SUBCAT_ID) {
    $product['mrp_inclusive_of'] = 'Kurta';
} elseif ($product['subcategory_id'] == $SHERWANI_SUBCAT_ID) {
    $product['mrp_inclusive_of'] = 'Sherwani';
} elseif ($product['subcategory_id'] == $WAISTCOAT_SUBCAT_ID) {
    $product['mrp_inclusive_of'] = 'Waistcoat';
} elseif ($is_vows_apparel) {
    $product['mrp_inclusive_of'] = 'Bride Ensemble | Groom Ensemble ';
} elseif ($product['subcategory_id'] == $BAGS_SUBCAT_ID) {
    $product['mrp_inclusive_of'] = 'Bag ';
} elseif ($product['subcategory_id'] == $BELT_SUBCAT_ID) {
    $product['mrp_inclusive_of'] = 'Belt ';
} elseif ($product['subcategory_id'] == $JEWELRY_SUBCAT_ID) {
    $product['mrp_inclusive_of'] = 'Diamond Set ';
} elseif ($product['subcategory_id'] == $CONTEMPORARY_SUBCAT_ID) {
    $product['mrp_inclusive_of'] = 'Top|Bottom|Saree';
}

$womens_size_fittings = [
    'S' => ['bust' => 34.5, 'waist' => 27.0, 'hip' => 37.0, 'shoulder' => 14.5],
    'M' => ['bust' => 36.5, 'waist' => 29.0, 'hip' => 39.0, 'shoulder' => 15.0],
    'L' => ['bust' => 38.5, 'waist' => 31.0, 'hip' => 40.9, 'shoulder' => 16.5],
    'XL' => ['bust' => 40.6, 'waist' => 33.0, 'hip' => 42.9, 'shoulder' => 17.0],
    'XXL' => ['bust' => 42.5, 'waist' => 35.0, 'hip' => 44.9, 'shoulder' => 17.5]
];

$mens_size_fittings = [
    'S' => ['chest' => 38.0, 'waist' => 32.0, 'hip' => 38.0, 'shoulder' => 17.5],
    'M' => ['chest' => 40.0, 'waist' => 34.0, 'hip' => 40.0, 'shoulder' => 18.0],
    'L' => ['chest' => 42.0, 'waist' => 36.0, 'hip' => 42.0, 'shoulder' => 18.5],
    'XL' => ['chest' => 44.0, 'waist' => 38.0, 'hip' => 44.0, 'shoulder' => 19.0],
    'XXL' => ['chest' => 46.0, 'waist' => 40.0, 'hip' => 46.0, 'shoulder' => 19.5]
];

if ($is_vows_apparel) {
    $active_size_fittings = ['womens' => $womens_size_fittings, 'mens' => $mens_size_fittings];
} elseif ($is_menswear_apparel) {
    $active_size_fittings = $mens_size_fittings;
} else {
    $active_size_fittings = $womens_size_fittings;
}

$size_chart_image = 'https://www.blitzresults.com/wp-content/uploads/womens-sizes-guide-how-to-measure.png';
if ($is_vows_apparel) {
    $size_chart_image = 'https://thumbs.dreamstime.com/b/men-women-standard-body-parts-terminology-measurements-illustration-clothes-accessories-production-fashion-head-male-206828569.jpg';
} elseif ($is_menswear_apparel) {
    $size_chart_image = 'https://www.blitzresults.com/wp-content/uploads/mens-sizes-guide-how-to-measure.png';
}

$related_products = array();
$sql_related = "SELECT id, name, price, image FROM products WHERE id != $product_id ORDER BY id DESC LIMIT 4";
$result_related = isset($conn) ? mysqli_query($conn, $sql_related) : false;
if ($result_related && mysqli_num_rows($result_related) > 0) {
    while ($row = mysqli_fetch_assoc($result_related)) $related_products[] = $row;
}
if (isset($conn)) mysqli_close($conn);

function format_price($price) { return 'INR ' . number_format($price); }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($product['name']); ?></title>
    <style>
        body { font-family: 'Inter', sans-serif; font-size: 14px; margin: 0; padding: 0; background-color: #f5f5dc; color: #333; }
        .container { max-width: 1200px; margin: 100px auto 20px auto; background-color: #f5f5dc; padding: 20px; }
        .product-main-area { display: flex; margin-bottom: 40px; }
        .product-image { flex: 1; padding-right: 20px; }
        .product-image img { width: 100%; height: auto; border-radius: 8px; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1); }
        .product-details { flex: 1; padding-left: 20px; }
        h1 { font-size: 28px; margin: 5px 0 10px; text-transform: uppercase; font-weight: 700; color: #1f2937; }
        .price { font-size: 32px; font-weight: bold; margin-bottom: 15px; color: #D62F65; }
        .tax-info { font-size: 14px; color: #666; margin-bottom: 20px; }
        .size-options { display: flex; align-items: center; margin-bottom: 15px; font-size: 14px; flex-wrap: wrap; }
        .size-label { font-weight: 600; margin-right: 10px; }
        .size-box { border: 1px solid #ccc; padding: 8px 12px; margin-right: 8px; cursor: pointer; min-width: 20px; text-align: center; font-size: 12px; transition: all 0.2s; border-radius: 4px; }
        .size-box.selected { border-color: #d62f65; background-color: #d62f65; color: #fff; font-weight: 600; }
        .size-chart { margin-left: auto; color: #D62F65; cursor: pointer; text-decoration: underline; font-size: 12px; font-weight: 500; }
        .shipping-time, .fitting-info { font-size: 14px; margin-bottom: 15px; }
        .buttons { margin-top: 20px; margin-bottom: 30px; }
        .add-to-cart, .buy-now { display: block; width: 100%; padding: 14px; font-size: 14px; text-align: center; cursor: pointer; margin-bottom: 10px; text-decoration: none; text-transform: uppercase; font-weight: bold; letter-spacing: 1px; transition: all 0.3s; border-radius: 6px; }
        .add-to-cart { background-color: #fff; color: #000; border: 1px solid #000; }
        .buy-now { background-color: #d62f65; color: #fff; border: 1px solid #d62f65; box-shadow: 0 4px 10px rgba(214, 47, 101, 0.3); }
        .add-to-cart:hover { background-color: #f0f0f0; }
        .buy-now:hover { background-color: #b02754; border-color: #b02754; }
        .accordion-item { border-bottom: 1px solid #eee; }
        .accordion-header { padding: 15px 0; display: flex; justify-content: space-between; cursor: pointer; font-weight: bold; font-size: 14px; text-transform: uppercase; color: #1f2937; }
        .accordion-content { padding: 0 0 15px 0; font-size: 14px; display: none; line-height: 1.5; color: #4b5563; }
        .plus-minus { font-size: 20px; line-height: 1; }
        #care { display: block; }
        .modal { display: none; position: fixed; z-index: 1000; left: 0; top: 0; width: 100%; height: 100%; overflow: auto; background-color: rgba(0,0,0,0.6); }
        .modal-content { background-color: #fefefe; margin: 10% auto; padding: 20px; border: 1px solid #888; width: 90%; max-width: 600px; border-radius: 8px; }
        .close-button { color: #aaa; float: right; font-size: 28px; font-weight: bold; cursor: pointer; }
    </style>
</head>
<body>
    <div class="container">
        <div class="product-main-area">
            <div class="product-image">
                <img src="<?php echo htmlspecialchars($product['image']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>" onerror="this.src='https://placehold.co/600x800/f0f0f0/333333?text=Product+Image'">
            </div>
            
            <div class="product-details">
                <h1><?php echo htmlspecialchars($product['name']); ?></h1>
                <div class="price"><?php echo format_price($product['price']); ?></div>
                <div class="tax-info">All Taxes are included in MRP. Shipping and Duties calculated at checkout</div>

                <?php if ($requires_sizing): ?>
                    <?php if ($is_vows_apparel): ?>
                        <!-- BRIDE SIZE BAR -->
                        <div class="size-options">
                            <span class="size-label">Bride Size:</span>
                            <?php foreach (['S','M','L','XL','XXL'] as $size): ?>
                                <div class="size-box <?php echo $size=='S'?'selected':''; ?>" data-gender="womens" data-size="<?php echo $size; ?>"><?php echo $size; ?></div>
                            <?php endforeach; ?>
                        </div>

                        <!-- GROOM SIZE BAR -->
                        <div class="size-options">
                            <span class="size-label">Groom Size:</span>
                            <?php foreach (['S','M','L','XL','XXL'] as $size): ?>
                                <div class="size-box <?php echo $size=='S'?'selected':''; ?>" data-gender="mens" data-size="<?php echo $size; ?>"><?php echo $size; ?></div>
                            <?php endforeach; ?>
                            <span class="size-chart" id="sizeChartLink">Size Chart</span>
                        </div>
                    <?php else: ?>
                        <div class="size-options">
                            <span>SIZE:</span>
                            <?php foreach (['S','M','L','XL','XXL'] as $size): ?>
                                <div class="size-box <?php echo $size=='S'?'selected':''; ?>" data-size="<?php echo $size; ?>"><?php echo $size; ?></div>
                            <?php endforeach; ?>
                            <span class="size-chart" id="sizeChartLink">Size Chart</span>
                        </div>
                    <?php endif; ?>

                    <div class="shipping-time">
                        Shipping: Made to order : <span id="shippingWeeks"><?php echo htmlspecialchars($product['made_to_order_weeks']); ?></span> weeks
                    </div>
                    <div class="fitting-info"></div>
                <?php else: ?>
                    <div class="size-options">
                        <span>SIZE:</span>
                        <div class="size-box selected">ONE SIZE</div>
                    </div>
                    <div class="shipping-time">Shipping: Ready to Ship - 3-5 business days</div>
                <?php endif; ?>

                <div class="buttons">
                    <!-- ADD TO CART -->
                    <form method="post" action="cart.php" class="add-to-cart-form" style="display:inline;">
        <input type="hidden" name="action" value="add">
        <input type="hidden" name="id" value="<?php echo $product_id; ?>">
        <input type="hidden" name="size" value="<?php echo $requires_sizing ? 'S' : 'ONE SIZE'; ?>">
        <?php if ($is_vows_apparel): ?>
            <input type="hidden" name="gender" value="womens">
        <?php endif; ?>
        <button type="submit" class="add-to-cart">ADD TO CART</button>
    </form>



<a id="buyNowLink" class="buy-now" href="buy_form.php?pid=<?php echo $product_id; ?>&size=S">
    Buy Now
</a></div>

                <!-- Product Details -->
                <div class="product-details-fixed">
                    <div style="font-weight: bold; font-size: 14px; text-transform: uppercase; margin-bottom: 10px; color: #D62F65;">PRODUCT DETAILS</div>
                    <p><?php echo htmlspecialchars($product['description']); ?></p>
                    <ul>
                        <li><strong>MRP Inclusive Of :</strong> <?php echo htmlspecialchars($product['mrp_inclusive_of']); ?></li>
                        <li><strong>Materials :</strong> <?php echo htmlspecialchars($product['materials']); ?></li>
                        <li><strong>Color :</strong> <?php echo htmlspecialchars($product['color']); ?></li>
                        <li><strong>Care Guide :</strong> <?php echo htmlspecialchars($product['care_guide']); ?></li>
                        <?php if ($requires_sizing): ?>
                            <li><strong>Made to Order :</strong> <?php echo htmlspecialchars($product['made_to_order_weeks']); ?> Weeks</li>
                            <li><strong>Model Wearing Size Small , Model Height :</strong> <?php echo htmlspecialchars($product['model_height']); ?></li>
                        <?php endif; ?>
                    </ul>
                </div>

                <!-- Accordions -->
                <div class="accordion-item">
                    <div class="accordion-header" data-content="shipping">SHIPPING & DELIVERY <span class="plus-minus">+</span></div>
                    <div class="accordion-content" id="shipping">
                        <ul><li>Prices are inclusive of all taxes, Packaging and handling.</li><li>Free Shipping in India.</li><li>For international purchases, duties and taxes may be applicable.</li></ul>
                    </div>
                </div>
                <div class="accordion-item">
                    <div class="accordion-header" data-content="care">CARE & GUIDE <span class="plus-minus">—</span></div>
                    <div class="accordion-content" id="care"><p><?php echo htmlspecialchars($product['care_guide']); ?></p></div>
                </div>
                <div class="accordion-item">
                    <div class="accordion-header" data-content="manufacturer">MANUFACTURER'S DETAILS <span class="plus-minus">+</span></div>
                    <div class="accordion-content" id="manufacturer">
                        <ul>
                            <li><strong>Manufactured and Packed By:</strong> <?php echo htmlspecialchars($product['manufacturer_name']); ?></li>
                            <li><strong>Address:</strong> <?php echo nl2br(htmlspecialchars($product['manufacturer_address'])); ?></li>
                            <li><strong>Email:</strong> <?php echo htmlspecialchars($product['manufacturer_email']); ?></li>
                            <li><strong>Tel:</strong> <?php echo htmlspecialchars($product['manufacturer_tel']); ?></li>
                            <li><strong>Country of Origin:</strong> <?php echo htmlspecialchars($product['country_of_origin']); ?></li>
                        </ul>
                    </div>
                </div>
                <div class="accordion-item">
                    <div class="accordion-header" data-content="disclaimer">DISCLAIMER <span class="plus-minus">+</span></div>
                    <div class="accordion-content" id="disclaimer"><p>Product color may slightly vary due to photographic lighting sources or your monitor setting.</p></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Size Chart Modal -->
    <div id="sizeChartModal" class="modal">
        <div class="modal-content">
            <span class="close-button">×</span>
            <h2>Size Chart</h2>
            <img src="<?php echo htmlspecialchars($size_chart_image); ?>" alt="Size Chart">
        </div>
    </div>

    <?php include 'footer.php'; ?>

    <!-- SINGLE SCRIPT BLOCK -->
    <script>
        // JAVASCRIPT LOGIC
        
        // Get the active size fittings data and flags from PHP
        const rawSizeData = <?php echo json_encode($active_size_fittings); ?>;
        const isMenswear = <?php echo json_encode($is_menswear_apparel); ?>;
        const isVows = <?php echo json_encode($is_vows_apparel); ?>;
        const requiresSizing = <?php echo json_encode($requires_sizing); ?>;

        let activeGender = isMenswear ? 'mens' : 'womens'; // Default gender for sizing lookup
        let sizeData = isVows ? rawSizeData.womens : rawSizeData; // Default size data set
        
        // Only proceed with sizing logic if sizing is required
        if (requiresSizing) {
            
            const sizeBoxes = document.querySelectorAll('.size-box[data-size]');
            
            // Function to update the fitting info display dynamically
            function updateFittingInfo(size, gender = activeGender) {
                // For Vows products, select the correct data set
                let currentDataSet = isVows ? rawSizeData[gender] : rawSizeData;
                const fittings = currentDataSet[size];

                if (!fittings) return;

                // Define labels and keys based on the selected gender/category
                const isCurrentMenswear = (isMenswear || isVows && gender === 'mens');
                
                let firstLabel = isCurrentMenswear ? 'Chest' : 'Bust';
                let firstKey = isCurrentMenswear ? 'chest' : 'bust';
                                                                                                                                                                                                                                                                                                                                            
                const fittingInfoEl = document.querySelector('.fitting-info');
                
                // Generate the inner HTML with dynamic labels and values
                fittingInfoEl.innerHTML = `Fitting: 
                    ${firstLabel} - <span id="bustSize">${fittings[firstKey].toFixed(1)}</span>in | 
                    Waist - <span id="waistSize">${fittings.waist.toFixed(1)}</span>in | 
                    Hip - <span id="hipSize">${fittings.hip.toFixed(1)}</span>in | 
                    Shoulder - <span id="shoulderSize">${fittings.shoulder.toFixed(1)}</span>in`;
            }

            // 1. Initialize fitting info on load with the default 'S' size and active gender
            updateFittingInfo('S', activeGender); 

            // 2. Attach size box click listeners
            sizeBoxes.forEach(box => {
                box.addEventListener('click', function() {
                    sizeBoxes.forEach(b => b.classList.remove('selected'));
                    this.classList.add('selected');

                    const selectedSize = this.getAttribute('data-size');
                    updateFittingInfo(selectedSize, activeGender);
                });
            });

            // 3. Vows Toggle Logic
            if (isVows) {
                const vowsToggles = document.querySelectorAll('.vows-toggle-btn');
                vowsToggles.forEach(toggle => {
                    toggle.addEventListener('click', function() {
                        vowsToggles.forEach(t => t.classList.remove('active'));
                        this.classList.add('active');

                        activeGender = this.getAttribute('data-gender');
                        
                        // Use the currently selected size (default to 'S' if none selected)
                        let selectedSizeBox = document.querySelector('.size-box.selected');
                        let currentSize = selectedSizeBox ? selectedSizeBox.getAttribute('data-size') : 'S';
                        
                        updateFittingInfo(currentSize, activeGender);
                    });
                });
            }
        } // End requiresSizing block

        // Accordion Logic
        var headers = document.querySelectorAll('.accordion-header');
        
        headers.forEach(header => {
            header.addEventListener('click', function() {
                var contentId = this.getAttribute('data-content');
                var content = document.getElementById(contentId);
                var plusMinus = this.querySelector('.plus-minus');

                if (content.style.display === 'block') {
                    content.style.display = 'none';
                    plusMinus.textContent = '+';
                } else {
                    // Close others
                    document.querySelectorAll('.accordion-content').forEach(c => {
                        c.style.display = 'none';
                        c.previousElementSibling.querySelector('.plus-minus').textContent = '+'; 
                    });

                    // Open this one
                    content.style.display = 'block';
                    plusMinus.textContent = '—'; 
                }
            });
        });

        // Modal Logic (Only runs if the size chart button exists for apparel)
        var modal = document.getElementById("sizeChartModal");
        var btn = document.getElementById("sizeChartLink");
        
        if(btn && modal){
            var span = document.getElementsByClassName("close-button")[0];

            btn.onclick = function() { modal.style.display = "block"; }
            span.onclick = function() { modal.style.display = "none"; }
            window.onclick = function(event) {
                if (event.target == modal) { modal.style.display = "none"; }
            }
        }
        // --- QUANTITY SELECTOR LOGIC (Ensures min=1) ---
// --- QUANTITY SELECTOR LOGIC (Ensures min=1) ---
const quantityInput = document.getElementById('quantity-input');
const decrementBtn = document.getElementById('decrement-btn');
const incrementBtn = document.getElementById('increment-btn');
const minQty = 1;

if (quantityInput && decrementBtn && incrementBtn) {
    
    // Decrement functionality
    decrementBtn.addEventListener('click', () => {
        let currentValue = parseInt(quantityInput.value);
        if (isNaN(currentValue)) currentValue = minQty;

        if (currentValue > minQty) {
            quantityInput.value = currentValue - 1;
        }
    });

    // Increment functionality
    incrementBtn.addEventListener('click', () => {
        let currentValue = parseInt(quantityInput.value);
        if (isNaN(currentValue)) currentValue = minQty;

        // Simple increment
        quantityInput.value = currentValue + 1;
    });

    // Prevent direct manual input and enforce minimum 1 on blur (safety)
    quantityInput.addEventListener('change', () => {
        let currentValue = parseInt(quantityInput.value);
        if (isNaN(currentValue) || currentValue < minQty) {
            quantityInput.value = minQty;
        }
    });
}
/////sizeeeeee
    document.addEventListener('DOMContentLoaded', function() {
        // 1. Get references to the elements
        const sizeBoxes = document.querySelectorAll('.size-box');
        const buyNowLink = document.getElementById('buyNowLink');
        
        // This variable stores the fixed part of the URL (e.g., 'buy_form.php?pid=123')
        // We will strip off any size parameter and append the new one later.
        // We use a safe version that ensures we only keep '...pid=XX'
        let baseHref = buyNowLink.href.split('&size=')[0]; 
        
        // Function to handle size selection and link update
        function handleSizeSelect(selectedBox) {
            const selectedSize = selectedBox.getAttribute('data-size');

            // --- A. Update Visual State ---
            // Remove 'selected' class from all boxes
            sizeBoxes.forEach(box => {
                box.classList.remove('selected');
            });
            // Add 'selected' class to the clicked box
            selectedBox.classList.add('selected');

            // --- B. Update the Buy Now Link ---
            // Construct the new URL: baseHref + &size= + new size
            buyNowLink.href = baseHref + '&size=' + selectedSize;
            
            // (Optional: for debugging in the browser console)
            console.log('Selected Size:', selectedSize);
            console.log('Updated Link:', buyNowLink.href);
        }

        // Add a click listener to every size box
        sizeBoxes.forEach(box => {
            box.addEventListener('click', function() {
                handleSizeSelect(this);
            });
            
            // Set the initial size on load if a box is already marked 'selected' by PHP
            if (box.classList.contains('selected')) {
                // Ensure the baseHref is correctly set based on the initial 'S'
                // and then explicitly set the initial link href to 'S'
                handleSizeSelect(box); 
            }
        });

        // Fallback: If no box was marked 'selected' by PHP, ensure a size is set, 
        // typically the first one.
        if (buyNowLink.href === baseHref) {
            if (sizeBoxes.length > 0) {
                 handleSizeSelect(sizeBoxes[0]);
            }
        }
    });

    
    </script>
</body>
</html>