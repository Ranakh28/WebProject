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
        
        <section class="admin-section">
            <h3>Add New Product</h3>
           
            <form class="add-product-form" method="POST" action="admin_logic.php">
                <input type="text" name="name" placeholder="Product Name" required>
                <input type="number" step="0.01" name="price" placeholder="Price ($)" required>
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
                        <th>Category</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    // جلب المنتجات المخزنة
                    $all_products = $conn->query("SELECT * FROM products");
                    if ($all_products->num_rows > 0):
                        while($row = $all_products->fetch_assoc()): 
                    ?>
                    <tr>
                        <td><?php echo $row['name']; ?></td>
                        <td><?php echo $row['price']; ?> SAR</td>
                        <td><?php echo $row['category']; ?></td>
                        <td>
                            <a href="admin_logic.php?delete=<?php echo $row['id']; ?>" 
                               class="btn-delete" 
                               style="color: red; text-decoration: none; border: 1px solid red; padding: 5px; border-radius: 5px;"
                               onclick="return confirmDelete()">Delete</a>
                        </td>
                    </tr>
                    <?php 
                        endwhile; 
                    else:
                        echo "<tr><td colspan='4'>No products found in database.</td></tr>";
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