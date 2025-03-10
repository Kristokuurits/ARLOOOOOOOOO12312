<?php
session_start();
?>

<!DOCTYPE html>
<html lang="et">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>A R L O</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

    <header>
        <?php if (isset($_SESSION['user_name']) || isset($_SESSION['admin_name'])): ?>
            <p>Tere, <?php echo $_SESSION['user_name'] ?? $_SESSION['admin_name']; ?>!</p>
            <a href="logout.php"><button class="login-btn">Logi välja</button></a>
        <?php else: ?>
            <a href="login.php"><button class="login-btn">Logi sisse</button></a>
        <?php endif; ?>

        <a href="admin_page.php" class="back-btn"> Muuda</a>
        
        <h1>- A R L O -</h1>
        <div class="icon-cart" onclick="toggleCart()">
            <img src="https://cdn-icons-png.flaticon.com/512/107/107831.png" alt="Ostukorv">
            <span id="cart-count">0</span>
        </div>
    </header>

    <section class="image-buttons category-box">
        <h3>- Choose Your Category -</h3>
        <div class="buttons-container">
            <button class="image-button" onclick="window.location.href='shoes.html'">
                <img src="images/shoes.webp" alt="Shoes">
                <p>Jalanõud</p>
            </button>
            <button class="image-button" onclick="window.location.href='hoodies.html'">
                <img src="images/hoodie.jpg" alt="Hoodies">
                <p>Kampsunid</p>
            </button>
            <button class="image-button" onclick="window.location.href='jeans.html'">
                <img src="images/jeans.webp" alt="Jeans">
                <p>Teksad</p>
            </button>
            <button class="image-button" onclick="window.location.href='hats.html'">
                <img src="images/razer-mice_categoryhero_1920x700.webp" alt="Hats">
                <p>Hiired</p>
            </button>
            <button class="image-button" onclick="window.location.href='shirts.html'">
                <img src="images/shirt.jpg" alt="Shirts">
                <p>Särgid</p>
            </button>
        </div>
    </section>

    <div class="cartTab">
        <div class="listCart">
            <h3>Your Cart</h3>
            <p>No items in the cart.</p>
            <button class="close" onclick="toggleCart()">Close</button>
        </div>
    </div>

    <script>
        let cartCount = 0;

        function toggleCart() {
            const cartTab = document.querySelector('.cartTab');
            cartTab.classList.toggle('open');
        }

        function addToCart() {
            cartCount++;
            document.getElementById('cart-count').innerText = cartCount;
        }

        const buttons = document.querySelectorAll('.image-button');
        buttons.forEach(button => {
            button.addEventListener('click', addToCart);
        });
    </script>

</body>
</html>
