<?php
@include 'config.php';
session_start();

if(isset($_POST['submit'])){
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $pass = md5($_POST['password']);

    $select = "SELECT * FROM user_form WHERE email = '$email' && password = '$pass'";
    $result = mysqli_query($conn, $select);

    if(mysqli_num_rows($result) > 0){
        $row = mysqli_fetch_array($result);

        if($row['user_type'] == 'admin'){
            $_SESSION['admin_name'] = $row['name'];
            header('location:admin_page.php');
        } elseif($row['user_type'] == 'user'){
            $_SESSION['user_name'] = $row['name'];
            header('location:index.php');
        }
    } else {
        $error[] = 'Incorrect email or password!';
    }
};
?>

<!DOCTYPE html>
<html lang="et">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
</head>
<body>

    <header>
        <h1>- A R L O -</h1>
    </header>

    <div class="form-container">
        <form action="" method="POST">
        <h3>Login Now</h3>
            <?php
            if(isset($error)){
                foreach($error as $error){
                    echo '<span class="error-msg">'.$error.'</span>';
                }
            }
            ?>
            <input type="email" name="email" required placeholder="Sisesta oma e-post">
            <input type="password" name="password" required placeholder="Sisesta oma parool">
            <input type="submit" name="submit" value="Logi sisse" class="form-btn">
            <p>Ei ole veel kontot? <a href="register_form.php">Registreeru nüüd</a></p>
            
            <a href="index.php" class="back-btn"> Tagasi</a>
        </form>
    </div>

</body>
</html>
