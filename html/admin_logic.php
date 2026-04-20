<?php
include 'db.php'; 

if (isset($_POST['add_product'])) {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity']; 
    $description = $_POST['description'];
    $category = $_POST['category'];
    $image_path = "default.jpg"; 

    $sql = "INSERT INTO products (name, description, price, quantity, image_path, category) 
            VALUES ('$name', '$description', '$price', '$quantity', '$image_path', '$category')";
    
    if ($conn->query($sql)) {
        header("Location: admin_dashboard.php?status=success");
        exit();
    } else {
        echo "Error: " . $conn->error;
    }
}

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $sql = "DELETE FROM products WHERE id = $id";
    
    if ($conn->query($sql)) {
        header("Location: admin_dashboard.php?status=deleted");
        exit();
    } else {
        echo "Error: " . $conn->error;
    }
}

if (isset($_POST['update_product'])) {
    $id = $_POST['id'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];
    
    $sql = "UPDATE products SET price = '$price', quantity = '$quantity' WHERE id = $id";
    
    if ($conn->query($sql)) {
        header("Location: admin_dashboard.php?status=updated");
        exit();
    } else {
        echo "Error: " . $conn->error;
    }
}
?>
