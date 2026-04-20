<?php
include 'db.php'; 

$search = $_GET['q'] ?? ''; 

$stmt = $conn->prepare("SELECT * FROM products WHERE name LIKE ?");
$searchTerm = "%" . $search . "%";
$stmt->bind_param("s", $searchTerm);
$stmt->execute();
$result = $stmt->get_result();

$products = array();
while ($row = $result->fetch_assoc()) {
    $products[] = $row;
}

echo json_encode($products);
$conn->close();
?>