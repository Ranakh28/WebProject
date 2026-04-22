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

    <main style="min-height: 80vh; padding-bottom: 50px;">
        <?php
        if (isset($_GET['query'])) {
            $search = trim(mysqli_real_escape_string($conn, $_GET['query']));
            
            if (!empty($search)) {
                $sql = "SELECT * FROM products WHERE 
                        LOWER(name) LIKE '%$search%' OR 
                        LOWER(category) LIKE '%$search%' OR 
                        LOWER(description) LIKE '%$search%'";
                
                $result = mysqli_query($conn, $sql);

                echo "<h2 class='page-heading' style='margin-top: 40px; text-align:center;'>Search Results for: '<span style='color: #4a1528;'>" . htmlspecialchars($search) . "</span>'</h2>";

                if ($result && mysqli_num_rows($result) > 0) {
                    echo "<div class='products'>";
                    
                    while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                        <div class="product">
                            <img src="../images/<?php echo htmlspecialchars($row['image_path']); ?>" alt="<?php echo htmlspecialchars($row['name']); ?>">
                            <h3><?php echo htmlspecialchars($row['name']); ?></h3>
                            <p class="category"><?php echo htmlspecialchars($row['category']); ?></p>
                            <p class="price"><?php echo number_format($row['price'], 2); ?> SAR</p>
                            
                            <button class="btn-add-cart">Add to Cart</button>
                        </div>
                        <?php
                    }
                    echo "</div>";
                } else {
                    ?>
                    <div class="no-results-section" style="text-align: center; padding: 80px 20px;">
                        <div class="no-results-card" style="background: #fff; padding: 40px; border-radius: 20px; box-shadow: 0 5px 20px rgba(0,0,0,0.05); display: inline-block; max-width: 500px;">
                            <i class="fa-solid fa-magnifying-glass-minus" style="font-size: 60px; color: #eee; margin-bottom: 20px;"></i>
                            <h2 style="color: #4a1528; margin-bottom: 10px;">Oops! No matches found</h2>
                            <p style="color: #777;">We couldn't find anything matching "<strong><?php echo htmlspecialchars($search); ?></strong>"</p>
                            <p style="font-size: 0.9rem; color: #999; margin: 15px 0;">Try checking the spelling or use more general keywords.</p>
                            <a href="../html/shop.php" class="btn-return" style="display: inline-block; padding: 12px 30px; background-color: #4a1528; color: white; border-radius: 25px; text-decoration: none; transition: 0.3s;">Return to Shop</a>
                        </div>
                    </div>
                    <?php
                }
            } else {
                echo "<script>window.location.href='../html/shop.php';</script>";
            }
        }
        ?>
    </main>

    <?php include '../html/footer.php'; ?>

</body>
</html>