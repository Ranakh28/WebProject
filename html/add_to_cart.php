<?php
session_start();
include 'db.php'; // ضروري جداً للاتصال بقاعدة البيانات

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['name'], $_POST['price'], $_POST['img'])) {
        $name = $_POST['name'];
        $price = (float)$_POST['price'];
        $img = $_POST['img'];
        
        // جلب اسم المستخدم من الجلسة، وإذا لم يوجد نضعه Guest
        $customer = $_SESSION['username'] ?? 'Guest';

        // 1. التخزين في "السلة" (Session) لكي يراها المستخدم في صفحة Cart.php
        $newItem = [
            'name'  => $name,
            'price' => $price,
            'img'   => $img,
            'qty'   => 1
        ];

        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }

        $found = false;
        foreach ($_SESSION['cart'] as &$item) {
            if ($item['name'] == $name) {
                $item['qty']++;
                $found = true;
                break;
            }
        }

        if (!$found) {
            $_SESSION['cart'][] = $newItem;
        }

   
        $sql = "INSERT INTO orders (customer_name, product_name, price, quantity, total_price) 
                VALUES ('$customer', '$name', '$price', 1, '$price')";
        
        if ($conn->query($sql)) {
            http_response_code(200);
            echo "success";
        } else {
            http_response_code(500);
            echo "Error: " . $conn->error;
        }
        exit();
    }
}
?>