<?php
// 1. تحديد نوع المحتوى ليكون JSON (مهم جداً ليفهمه الجافاسكربت)
header('Content-Type: application/json');

// 2. بيانات الاتصال بقاعدة البيانات
$host = "localhost";
$username = "root";
$password = "";
$dbname = "makeup_db";

// 3. إنشاء الاتصال
$conn = new mysqli($host, $username, $password, $dbname);

// 4. التحقق من الاتصال
if ($conn->connect_error) {
    // في حال الخطأ نرسل رسالة بصيغة JSON
    die(json_encode(["error" => "Connection failed: " . $conn->connect_error]));
}

// 5. الاستعلام عن المنتجات من الجدول
$sql = "SELECT * FROM products";
$result = $conn->query($sql);

$products = array();

// 6. تحويل النتيجة إلى مصفوفة
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $products[] = $row;
    }
}

// 7. إرسال المصفوفة بصيغة JSON
echo json_encode($products);

// 8. إغلاق الاتصال
$conn->close();
?>