<?php
@include 'config.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    echo json_encode(["error" => "Kasutaja pole sisse logitud"]);
    exit();
}

$user_id = $_SESSION['user_id'];
$cart_data = json_decode(file_get_contents("php://input"), true);

mysqli_query($conn_cart, "DELETE FROM cart WHERE user_id = $user_id");

foreach ($cart_data as $item) {
    $name = mysqli_real_escape_string($conn_cart, $item['name']);
    $price = mysqli_real_escape_string($conn_cart, $item['price']);
    $size = mysqli_real_escape_string($conn_cart, $item['size']);
    $quantity = mysqli_real_escape_string($conn_cart, $item['quantity']);

    $query = "INSERT INTO cart (user_id, product_name, price, size, quantity) 
              VALUES ($user_id, '$name', $price, '$size', $quantity)";
    mysqli_query($conn_cart, $query);
}

echo json_encode(["success" => "Ostukorv salvestatud"]);
?>
