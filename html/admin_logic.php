<?php
include 'db.php'; 


if (isset($_POST['add_product'])) {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $desc = $_POST['description'];
    $cat = $_POST['category'];
    $img = "default.jpg"; 

    $sql = "INSERT INTO products (name, description, price, image_path, category) 
            VALUES ('$name', '$desc', '$price', '$img', '$cat')";
    
    if ($conn->query($sql)) {
        header("Location: admin_dashboard.php?status=success");
    } else {
        echo "Error: " . $conn->error;
    }
}

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    
    $sql = "DELETE FROM products WHERE id = $id";
    
    if ($conn->query($sql)) {
        header("Location: admin_dashboard.php?status=deleted");
    } else {
        echo "Error deleting: " . $conn->error;
    }
}

if (isset($_POST['update_product'])) {
    $id = $_POST['id'];
    $price = $_POST['price'];
    
    $sql = "UPDATE products SET price = '$price' WHERE id = $id";
    $conn->query($sql);
    header("Location: admin_dashboard.php");
}
?>