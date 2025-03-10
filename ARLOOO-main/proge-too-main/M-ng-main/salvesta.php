<?php

@include 'config.php'; // Kui soovid kasutada `user_db`, aga muudame ühenduse otse.

$product_conn = mysqli_connect('localhost', 'root', '', 'product_db'); 

if (!$product_conn) {
    die("Ühenduse ebaõnnestumine: " . mysqli_connect_error());
}

$product_name = $_POST['product_name'];
$product_price = $_POST['product_price'];

// Kontrolli, kas teenuste tabel eksisteerib product_db andmebaasis
$sql = "INSERT INTO services (name, price) VALUES (?, ?)";
$stmt = $product_conn->prepare($sql);
$stmt->bind_param("sd", $product_name, $product_price);

if ($stmt->execute()) {
    echo "<script>
        alert('Teenus edukalt lisatud!');
        window.location.href = 'admin_page.php';
    </script>";
} else {
    echo "<script>
        alert('Teenuse lisamine ebaõnnestus. Proovi uuesti.');
        window.location.href = 'edit_user.php';
    </script>";
}

$stmt->close();
$product_conn->close();

?>
