<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $newItem = [
        'name' => $_POST['name'],
        'price' => (float)$_POST['price'],
        'img' => $_POST['img'],
        'qty' => 1
    ];

    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    // إذا المنتج موجود مسبقاً، نزيد الكمية فقط
    $found = false;
    foreach ($_SESSION['cart'] as &$item) {
        if ($item['name'] == $newItem['name']) {
            $item['qty']++;
            $found = true;
            break;
        }
    }

    if (!$found) {
        $_SESSION['cart'][] = $newItem;
    }
}

header("Location: products.php");
exit();