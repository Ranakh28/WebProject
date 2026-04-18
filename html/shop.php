<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Glowberry Store | Luxury Beauty</title>
    <link rel="stylesheet" href="../css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Poppins:wght@300;400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>

<?php include 'header.php';?>

<h1 style="text-align:center; margin-top:30px;">Our Products</h1>

<div class="filters">
    <button onclick="filterProducts('all')">All</button>
    <button onclick="filterProducts('eyes')">Eyes</button>
    <button onclick="filterProducts('lips')">Lips</button>
    <button onclick="filterProducts('face')">Face</button>
</div>

<div class="products" id="productList">
</div>

<script src="../js/shop.js"></script>

<?php include 'footer.php';?>

</body>
</html>