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
    <style>

        .back-btn {
            display: inline-block;
            padding: 10px 15px;
            background-color: rgb(255, 255, 255);
            color: black;
            text-decoration: none;
            border-radius: 5px;
            font-size: 16px;
            transition: background-color 0.3s ease;
            border: none;
            cursor: pointer;
            position: absolute;
            left: 290px;
        }

        .login-btn {
            cursor: pointer;
            position: absolute;
            left: 150px;
            top: 22px;
        }

        .back-btn:hover {
            background-color: rgb(190, 190, 190);
        }

        h1 {
    position: relative; 
    left: -430px; 
}

    </style>
</head>
<body>

    <header>
        <?php if (isset($_SESSION['user_name']) || isset($_SESSION['admin_name'])): ?>
            <p>Tere, <?php echo $_SESSION['user_name'] ?? $_SESSION['admin_name']; ?>!</p>
            <a href="logout.php"><button class="login-btn">Logi välja</button></a>

            <?php if (isset($_SESSION['admin_name'])): ?>
                <a href="admin_page.php" class="back-btn">Muuda</a>
            <?php endif; ?>

        <?php else: ?>
            <a href="login.php"><button class="login-btn">Logi sisse</button></a>
        <?php endif; ?>

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
                <img src="images/comp.webp" alt="Shoes">
                <p>Arvutikomponendid</p>
            </button>
            <button class="image-button" onclick="window.location.href='hoodies.html'">
                <img src="images/monitor.jpg" alt="Hoodies">
                <p>Monitorid</p>
            </button>
            <button class="image-button" onclick="window.location.href='jeans.html'">
                <img src="images/keyboard.jpg" alt="Jeans">
                <p>Klaviatuurid</p>
            </button>
            <button class="image-button" onclick="window.location.href='hats.html'">
                <img src="images/mouse.jpg" alt="Hats">
                <p>Hiired</p>
            </button>
        </div>
    </section>

    <div class="cartTab">
        <div class="listCart">
            <h3>Your Cart</h3>
            <p>No items in the cart.</p>
            <button class="close" onclick="toggleCart()">Sulge</button>
            <button class="checkout" onclick="checkout()">Maksmine</button>
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
