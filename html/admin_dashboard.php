<?php include 'admin_logic.php'; ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard | Makeup Store</title>
    <link rel="stylesheet" href="../css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Poppins:wght@300;400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>

<?php include 'header.php';?>

<main class="admin-main">
    <div class="admin-wrapper">
        <h1 class="page-heading">Store Management</h1>
        
        <div style="text-align: center; margin: 20px 0;">
    <a href="admin_orders.php" class="btn-add-cart" style="text-decoration: none; padding: 10px 25px;">
        View Customer Orders Log 📋
    </a>
</div>
        
        <section class="admin-section">
            <h3>Add New Product</h3>
           
            <form class="add-product-form" method="POST" action="admin_logic.php">
                <input type="text" name="name" placeholder="Product Name" required>
                <input type="number" step="0.01" name="price" placeholder="Price ($)" required>
                <input type="number" name="quantity" placeholder="Stock Quantity" required>
                <input type="text" name="description" placeholder="Description">
                <select name="category" class="inline-input">
                    <option value="lips">Lips</option>
                    <option value="eyes">Eyes</option>
                    <option value="face">Face</option>
                </select>
                <button type="submit" name="add_product" class="btn-main">Add to Store</button>
            </form>
        </section>

     <section class="admin-section">
    <h3>Current Inventory</h3>
    <table class="inventory-table">
        <thead>
            <tr>
                <th>Product</th>
                <th>Price</th>
                <th>Quantity</th> 
                <th>Category</th>
                <th>Action</th>
            </tr>
        </thead>
        
        <tbody>
    <?php 
    $all_products = $conn->query("SELECT * FROM products");
    if ($all_products && $all_products->num_rows > 0):
        while($row = $all_products->fetch_assoc()): 
    ?>
    <tr>
        <form method="POST" action="admin_logic.php">
            <td><?php echo $row['name']; ?></td>
            <td>
                <input type="number" step="0.01" name="price" value="<?php echo $row['price']; ?>" class="inline-input" style="width: 80px;">
            </td>
            <td>
                <input type="number" name="quantity" value="<?php echo $row['quantity']; ?>" class="inline-input" style="width: 60px;">
                <?php if ($row['quantity'] <= 0) echo '<br><span style="color: red; font-size: 12px;">Sold Out</span>'; ?>
            </td>
            <td><?php echo $row['category']; ?></td>
            <td>
                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                <button type="submit" name="update_product" class="btn-save" style="background-color: #4CAF50; color: white; border: none; padding: 5px 10px; border-radius: 4px; cursor: pointer;">Save</button>
                <a href="admin_logic.php?delete=<?php echo $row['id']; ?>" class="btn-delete" style="color: red; margin-left: 10px; text-decoration: none;" onclick="return confirmDelete()">Delete</a>
            </td>
        </form>
    </tr>
    <?php 
        endwhile;
    else:
        echo "<tr><td colspan='5' style='text-align:center;'>No products found.</td></tr>";
    endif; 
    ?>
</tbody>
    </table>
</section>
    </div>
</main>

<?php include 'footer.php';?>

<script>
    function confirmDelete() {
        return confirm("Are you sure you want to delete this product?");
    }
</script>
</body>
</html>
