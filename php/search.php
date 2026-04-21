<?php
include 'db.php'; 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Results - Glowberry</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>

    <?php include '../html/header.php'; ?>

    <main style="min-height: 80vh;">
        <?php
        if (isset($_GET['query'])) {
         $search = mysqli_real_escape_string($conn, $_GET['query']);

         $sql = "SELECT * FROM products WHERE name LIKE '$search%' OR category LIKE '$search%'";

            $result = mysqli_query($conn, $sql);

            echo "<h2 class='page-heading' style='margin-top: 40px;'>Search Results for: '" . htmlspecialchars($search) . "'</h2>";

            if (mysqli_num_rows($result) > 0) {
                echo "<div class='products'>";
                
                while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                    <div class="product">
                        <img src="../images/<?php echo $row['image_path']; ?>" alt="<?php echo $row['name']; ?>">
                        <h3><?php echo $row['name']; ?></h3>
                        <p class="category"><?php echo $row['category']; ?></p>
                        <p class="price"><?php echo number_format($row['price'], 2); ?> SAR</p>
                        
                        <button class="btn-add-cart">Add to Cart</button>
                    </div>
                    <?php
                }
                echo "</div>";
            } else {
                echo "<div style='text-align: center; padding: 50px;'>
                        <p style='color: #888;'>No products found matching your search.</p>
                        <a href='../html/shop.php' style='color: var(--primary-color); text-decoration:none;'>Return to Shop</a>
                      </div>";
            }
        }
        ?>
    </main>

    <?php include '../html/footer.php'; ?>

</body>
</html>