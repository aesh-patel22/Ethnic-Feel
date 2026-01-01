<?php

$conn = mysqli_connect("localhost", "root", "", "ethnic_store");
if (!$conn) die("Connection failed: " . mysqli_connect_error());

// === METRICS ===
$total_users = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as c FROM users"))['c'];
$total_orders = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as c FROM orders"))['c'];
$total_revenue = mysqli_fetch_assoc(mysqli_query($conn, "SELECT SUM(product_price) as s FROM orders"))['s'] ?? 0;
$new_orders = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as c FROM orders WHERE order_date >= DATE_SUB(NOW(), INTERVAL 7 DAY)"))['c'];

// === SEGMENTATION (Doughnut Chart Data) ===
$segments_query = "
    SELECT 
        segment_label,
        COUNT(*) AS count
    FROM (
        SELECT 
            u.id,
            CASE 
                WHEN COALESCE(SUM(o.product_price), 0) < 500 THEN 'Low'
                WHEN COALESCE(SUM(o.product_price), 0) < 2000 THEN 'Medium'
                WHEN COALESCE(SUM(o.product_price), 0) < 5000 THEN 'High'
                ELSE 'VIP'
            END AS segment_label
        FROM users u 
        LEFT JOIN orders o ON u.id = o.user_id
        GROUP BY u.id
    ) AS user_segments
    GROUP BY segment_label
    ORDER BY FIELD(segment_label, 'VIP', 'High', 'Medium', 'Low')
";
$segments = mysqli_query($conn, $segments_query);

// ------------------------------------------------------------------
// === PRODUCT ANALYSIS (Bar Chart Data) ===
// Joins orders (o) and products (p) to get aggregate data per product.
// ------------------------------------------------------------------
$products_query = "
    SELECT 
        p.name as product_name,
        COUNT(DISTINCT o.user_id) AS customers,
        SUM(o.product_price) AS spent
    FROM orders o
    JOIN products p ON o.product_id = p.id
    GROUP BY p.id, p.name
    ORDER BY spent DESC
    LIMIT 10
";
$products = mysqli_query($conn, $products_query);


// ------------------------------------------------------------------
// === NEW: CATEGORY ANALYSIS (Max Orders per Category Table) ===
// FIX: Joins orders -> products -> subcategories -> categories
// to group sales by the main category name.
// ------------------------------------------------------------------
$categories_query = "
    SELECT 
        s.sub_name AS subcategory_name,
        COUNT(o.product_id) AS total_orders,
        SUM(o.product_price) AS total_sales
    FROM orders o
    JOIN products p ON o.product_id = p.id
    JOIN subcategories s ON p.subcategory_id = s.id
    JOIN categories c ON s.category_id = c.id
    GROUP BY c.id, s.sub_name
    ORDER BY total_orders DESC
";
$categories = mysqli_query($conn, $categories_query); 
if (!$categories) {
    // If the query fails (e.g., table/column names are wrong), capture the error
    $category_error = "Category query failed. Check your table structure: " . mysqli_error($conn);
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Admin Dashboard</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<style>
    body { font-family: 'Inter', sans-serif; background: #f5f5dc; margin: 0; padding: 40px; }
    .dashboard { max-width: 1200px; margin: auto; }
    h2 { color: #D62F65; margin-top: 30px; border-bottom: 2px solid #D62F65; padding-bottom: 5px; }
    
    /* Metrics Layout */
    .metrics { display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 20px; margin-bottom: 40px; }
    
    /* Chart Layout FIX: Two columns for charts */
    .charts { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 40px; }
    
    .card { background: white; padding: 20px; border-radius: 12px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); text-align: center; }
    .card.full-width { grid-column: 1 / -1; } /* For the table to span both columns */
    .card h3 { color: #D62F65; font-size: 18px; margin-bottom: 10px; }
    .card p { font-size: 28px; font-weight: 700; margin: 0; }
    .card .note { font-size: 12px; color: #666; margin-top: 10px; }
    
    /* Table Styling */
    .data-table { width: 100%; border-collapse: collapse; margin-top: 20px; }
    .data-table th, .data-table td { padding: 12px 15px; text-align: left; border-bottom: 1px solid #eee; }
    .data-table th { background-color: #fdf6f6; color: #D62F65; font-weight: 600; }
    .data-table tr:hover { background-color: #f9f9f9; }
</style>
</head>
<body>

<div class="dashboard">
    <h2>📈 Key Metrics</h2>
    <div class="metrics">
        <div class="card"><h3>Total Users</h3><p><?= $total_users ?></p><p class="note">Registered customers.</p></div>
        <div class="card"><h3>Total Orders</h3><p><?= $total_orders ?></p><p class="note">All time orders.</p></div>
        <div class="card"><h3>Total Revenue</h3><p>₹<?= number_format($total_revenue) ?></p><p class="note">Total sales value.</p></div>
        <div class="card"><h3>New Orders (7 Days)</h3><p><?= $new_orders ?></p><p class="note">Recent activity.</p></div>
    </div>

    <h2>📊 Analysis & Visuals</h2>
    <!-- CHARTS (Now side-by-side using the .charts grid) -->
    <div class="charts">
        <div class="card">
            <h3>Customer Segments (Doughnut)</h3>
            <canvas id="segmentChart"></canvas>
            <p class="note">Segments based on lifetime customer spending.</p>
        </div>
        
        <div class="card">
            <h3>Top 10 Product Revenue</h3>
            <canvas id="productChart"></canvas>
            <p class="note">Total revenue generated by each product.</p>
        </div>
    </div>
    
    <!-- CATEGORY TABLE (Full Width) -->
    <div class="card full-width">
        <h3>🛍️ Max Orders by Category</h3>
        <?php if (isset($category_error)): ?>
            <p style="color: red;"><?= htmlspecialchars($category_error) ?></p>
        <?php elseif ($categories && mysqli_num_rows($categories) > 0): ?>
            <table class="data-table">
                <thead>
                    <tr>
                        <th>Category Name</th>
                        <th>Total Orders</th>
                        <th>Total Revenue</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($c = mysqli_fetch_assoc($categories)): ?>
                        <tr>
                            <td><?= htmlspecialchars($c['subcategory_name']) ?></td>
                            <td><?= $c['total_orders'] ?></td>
                            <td>₹<?= number_format($c['total_sales']) ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>No category order data available. Check that products are linked to subcategories, and subcategories are linked to categories.</p>
        <?php endif; ?>
    </div>

</div>

<script>
// === SEGMENTATION CHART (DOUGHNUT) ===
const segLabels = [];
const segData = [];
<?php
// Ensure segments result is available before attempting to seek/fetch
if ($segments) {
    mysqli_data_seek($segments, 0);
    while ($s = mysqli_fetch_assoc($segments)) {
        echo "segLabels.push('".addslashes($s['segment_label'])."'); segData.push({$s['count']});";
    }
}
?>

new Chart(document.getElementById('segmentChart'), {
  type: 'doughnut',
  data: {
    labels: segLabels,
    datasets: [{ 
        data: segData, 
        backgroundColor: ['#D62F65', '#ff9999', '#ffcc99', '#99ccff'] 
    }]
  },
  options: { responsive: true, plugins: { legend: { position: 'bottom' } } }
});

// === PRODUCT CHART (BAR) ===
const prodLabels = [];
const prodData = [];
<?php
// Ensure products result is available before attempting to seek/fetch
if ($products) {
    mysqli_data_seek($products, 0);
    while ($p = mysqli_fetch_assoc($products)) {
        echo "prodLabels.push('".addslashes($p['product_name'])."'); prodData.push({$p['spent']});";
    }
}
?>

new Chart(document.getElementById('productChart'), {
  type: 'bar',
  data: {
    labels: prodLabels,
    datasets: [{ 
      label: 'Total Revenue (₹)',
      data: prodData, 
      backgroundColor: '#D62F65', 
      borderColor: '#D62F65',
      borderWidth: 1 
    }]
  },
  options: { 
    responsive: true, 
    plugins: { legend: { display: false } },
    scales: {
      y: { 
        beginAtZero: true,
        title: { display: true, text: 'Revenue (₹)' }
      }
    }
  }
});
</script>
</body>
</html>