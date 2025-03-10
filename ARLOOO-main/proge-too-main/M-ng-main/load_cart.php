<?php
@include 'config.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    echo json_encode([]);
    exit();
}

$user_id = $_SESSION['user_id'];
$result = mysqli_query($conn_cart, "SELECT * FROM cart WHERE user_id = $user_id");
$cart_items = [];

while ($row = mysqli_fetch_assoc($result)) {
    $cart_items[] = [
        "name" => $row["product_name"],
        "price" => $row["price"],
        "size" => $row["size"],
        "quantity" => $row["quantity"]
    ];
}

echo json_encode($cart_items);
?>
