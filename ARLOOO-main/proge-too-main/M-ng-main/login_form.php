<?php

@include 'config.php';

session_start();

if(isset($_POST['submit'])){

    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $pass = md5($_POST['password']);

    $select = "SELECT * FROM user_form WHERE email = '$email' && password = '$pass' ";
    $result = mysqli_query($conn, $select);

    if(mysqli_num_rows($result) > 0){

        $row = mysqli_fetch_array($result);

        $_SESSION['user_name'] = $row['name']; 
        $_SESSION['user_type'] = $row['user_type'];

        header('location:index.php');
        exit();
        
    } else {
        $error[] = 'Incorrect email or password!';
    }
}
?>

<!DOCTYPE html>
<html lang="et">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<div class="form-container">
    <form action="" method="post">
        <h3>Logi sisse</h3>
        <?php
        if(isset($error)){
            foreach($error as $error){
                echo '<span class="error-msg">'.$error.'</span>';
            }
        }
        ?>
        <input type="email" name="email" required placeholder="Sisesta oma e-mail">
        <input type="password" name="password" required placeholder="Sisesta oma parool">
        <input type="submit" name="submit" value="Logi sisse" class="form-btn">
        <p>Pole kontot? <a href="register_form.php">Registreeri</a></p>

        <a href="index.php" class="back-btn"> Tagasi</a>
    </form>
</div>

</body>
</html>
