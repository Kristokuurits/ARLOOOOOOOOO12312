<?php

@include 'config.php';

session_start();

if (isset($_POST['submit'])) {

    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $pass = md5($_POST['password']);
    $cpass = md5($_POST['cpassword']);
    $user_type = $_POST['user_type'];

    $select = "SELECT * FROM user_form WHERE email = '$email'";
    $result = mysqli_query($conn, $select);

    if (mysqli_num_rows($result) > 0) {
        $error[] = 'Kasutaja on juba olemas!';
    } else {
        if ($pass != $cpass) {
            $error[] = 'Paroolid ei ühti!';
        } else {
            $insert = "INSERT INTO user_form (name, email, password, user_type) VALUES ('$name', '$email', '$pass', '$user_type')";
            if (mysqli_query($conn, $insert)) {
                $_SESSION['user_name'] = $name;
                $_SESSION['user_type'] = $user_type;
                header('location:index.php');
                exit();
            } else {
                echo "Viga: " . $insert . "<br>" . mysqli_error($conn);
            }
        }
    }
}

?>

<!DOCTYPE html>
<html lang="et">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registreerimisvorm</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<div class="form-container">
    <form action="" method="post">
        <h3>Registreeru</h3>

        <?php
        if (isset($error)) {
            foreach ($error as $error_msg) {
                echo '<span class="error-msg">' . $error_msg . '</span><br>';
            }
        }
        ?>

        <input type="text" name="name" required placeholder="Sisesta oma nimi">
        <input type="email" name="email" required placeholder="Sisesta oma e-mail">
        <input type="password" name="password" required placeholder="Sisesta oma parool">
        <input type="password" name="cpassword" required placeholder="Korda parooli">
        <select name="user_type">
            <option value="user">Kasutaja</option>
            <option value="admin">Admin</option>
        </select>
        <input type="submit" name="submit" value="Registreeru" class="form-btn">
        <p>Juba konto olemas? <a href="login_form.php">Logi sisse</a></p>

        <a href="index.php" class="back-btn"> Tagasi</a>
    </form>
</div>

</body>
</html>
