<?php 
session_start(); 

// --- منطق التحكم في السلة (إضافة، حذف، تعديل) ---
if (isset($_GET['action'])) {
    $id = $_GET['id'];
    
    // 1. زيادة الكمية
    if ($_GET['action'] == 'increase') {
        $_SESSION['cart'][$id]['qty']++;
    }
    // 2. تقليل الكمية
    if ($_GET['action'] == 'decrease') {
        if ($_SESSION['cart'][$id]['qty'] > 1) {
            $_SESSION['cart'][$id]['qty']--;
        } else {
            unset($_SESSION['cart'][$id]); // حذف إذا وصلت الصفر
        }
    }
    // 3. حذف المنتج نهائياً
    if ($_GET['action'] == 'delete') {
        unset($_SESSION['cart'][$id]);
    }
    
    // إعادة التوجيه لنفس الصفحة لتحديث البيانات ومنع تكرار العملية عند عمل Refresh
    header("Location: cart.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Shopping Cart</title>
<style>
    :root { 
        --primary: #671D2D; 
        --bg: #FAF7F2; 
        --accent: #E2C2C6; 
        --text: #2A1B18;
        --danger: #a94442;
    }
    body { 
        font-family: 'Segoe UI', sans-serif; 
        background: linear-gradient(135deg, #FAF7F2, #E2C2C6); 
        margin: 0; 
        display: flex; 
        justify-content: center; 
        align-items: center; 
        min-height: 100vh; 
    }
    .cart-container { 
        background: white; 
        padding: 35px; 
        border-radius: 18px; 
        box-shadow: 0 15px 40px rgba(0,0,0,0.12); 
        width: 95%; 
        max-width: 700px; 
        text-align: center; 
    }
    h2 { color: var(--primary); margin-bottom: 20px; }
    table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
    th { border-bottom: 2px solid var(--accent); padding: 15px 10px; color: var(--primary); }
    td { padding: 15px 10px; border-bottom: 1px solid #eee; color: var(--text); vertical-align: middle; }
    
    /* تنسيق الصورة المصغرة */
    .prod-img {
        width: 50px;
        height: 50px;
        object-fit: cover;
        border-radius: 8px;
        margin-right: 10px;
        vertical-align: middle;
        border: 1px solid var(--accent);
    }

    /* أزرار التحكم في الكمية */
    .qty-btn {
        text-decoration: none;
        background: var(--accent);
        color: var(--primary);
        padding: 2px 8px;
        border-radius: 5px;
        font-weight: bold;
        font-size: 14px;
    }
    .qty-btn:hover { background: var(--primary); color: white; }

    /* زر الحذف */
    .btn-delete {
        color: var(--danger);
        text-decoration: none;
        font-size: 18px;
        margin-left: 10px;
    }

    .btn-pay { 
        display: inline-block;
        width: 100%;
        box-sizing: border-box;
        padding: 12px;
        margin-top: 15px;
        background: var(--primary);
        color: white;
        text-decoration: none;
        border-radius: 10px;
        font-weight: bold;
        transition: 0.3s;
    }
    .btn-pay:hover { background: var(--text); }
    .empty-msg { padding: 30px; color: gray; }
    
    .product-info { display: flex; align-items: center; text-align: left; }
</style>
</head>
<body>

<div class="cart-container">
    <h2>Your Shopping Cart</h2>

    <?php if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0): ?>
        <table>
            <thead>
                <tr>
                    <th style="text-align: left;">Product</th>
                    <th>Price</th>
                    <th>Qty</th>
                    <th>Total</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $subtotal = 0;
                foreach ($_SESSION['cart'] as $id => $item): 
                    $total = $item['price'] * $item['qty'];
                    $subtotal += $total;
                    
$imagePath = isset($item['img']) ? '../images/' . $item['img'] : '../images/placeholder.jpg';                ?>
                <tr>
                    <td>
                        <div class="product-info">
                            <img src="<?php echo $imagePath; ?>" alt="img" class="prod-img">
                            <span><?php echo htmlspecialchars($item['name']); ?></span>
                        </div>
                    </td>
                    <td><?php echo number_format($item['price'], 2); ?></td>
                    <td>
                        <a href="?action=decrease&id=<?php echo $id; ?>" class="qty-btn">-</a>
                        <span style="margin: 0 8px;"><?php echo $item['qty']; ?></span>
                        <a href="?action=increase&id=<?php echo $id; ?>" class="qty-btn">+</a>
                    </td>
                    <td><?php echo number_format($total, 2); ?></td>
                    <td>
                        <a href="?action=delete&id=<?php echo $id; ?>" class="btn-delete" title="Remove">🗑</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <div style="text-align: right; border-top: 1px solid #eee; padding-top: 10px;">
            <p>Subtotal: <strong><?php echo number_format($subtotal, 2); ?> SAR</strong></p>
            <p>Tax (15%): <strong><?php echo number_format($subtotal * 0.15, 2); ?> SAR</strong></p>
            <h3 style="color: var(--primary);">Total: <?php echo number_format($subtotal * 1.15, 2); ?> SAR</h3>
            
            <a href="login.php?redirect=pay.php" class="btn-pay">Proceed to Payment</a>
        </div>

    <?php else: ?>
        <div class="empty-msg">
            <p>Your cart is empty! 🛒</p>
<a href="shop.php" style="color: var(--primary); text-decoration: none; font-weight: bold;">← Back to Shop</a>        </div>
    <?php endif; ?>
</div>

</body>
</html>
