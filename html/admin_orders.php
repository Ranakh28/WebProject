<?php
include 'db.php';
// جلب الطلبات مرتبة من الأحدث إلى الأقدم
$sql = "SELECT * FROM orders ORDER BY order_date DESC";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Logs | Admin Dashboard</title>
    <link rel="stylesheet" href="../css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Poppins:wght@300;400;500&display=swap" rel="stylesheet">
    <style>
        .admin-orders-container {
            padding: 40px 5%;
            max-width: 1200px;
            margin: 0 auto;
        }
        .orders-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background: #fff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }
        .orders-table th {
            background-color: var(--primary-color);
            color: white;
            padding: 15px;
            text-align: left;
        }
        .orders-table td {
            padding: 15px;
            border-bottom: 1px solid #eee;
        }
        /* تعديل تصميم الحالة لتناسب وضع "In Cart" */
        .status-badge {
            background-color: #fff3cd; /* لون أصفر خفيف */
            color: #856404; /* لون بني للخط */
            padding: 5px 12px;
            border-radius: 15px;
            font-size: 0.85rem;
            font-weight: bold;
            display: inline-block;
        }
    </style>
</head>
<body>

<?php include 'header.php'; ?>

<main class="admin-orders-container">
    <h1 class="page-heading">Customer Orders</h1>
    
    <div style="margin-bottom: 20px;">
        <a href="admin_dashboard.php" class="btn-add-cart" style="text-decoration: none;">← Back to Inventory</a>
    </div>

    <table class="orders-table">
        <thead>
            <tr>
                <th>Order ID</th>
                <th>Customer</th>
                <th>Product</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Total</th>
                <th>Date</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($result && $result->num_rows > 0): ?>
                <?php while($row = $result->fetch_assoc()): ?>
                <tr>
                    <td>#<?php echo $row['id']; ?></td>
                    <td><?php echo htmlspecialchars($row['customer_name']); ?></td>
                    <td><?php echo htmlspecialchars($row['product_name']); ?></td>
                    <td><?php echo $row['price']; ?> SAR</td>
                    <td><?php echo $row['quantity']; ?></td>
                    <td><?php echo $row['total_price']; ?> SAR</td>
                    <td><?php echo date('Y-m-d H:i', strtotime($row['order_date'])); ?></td>
                    <td><span class="status-badge">In Cart</span></td>
                </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="8" style="text-align:center; padding: 30px; color: #666;">No orders available.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</main>

<?php include 'footer.php'; ?>

</body>
</html>