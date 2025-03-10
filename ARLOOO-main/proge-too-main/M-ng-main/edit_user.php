<?php
@include 'config.php';
session_start();

if (!isset($_SESSION['admin_name'])) {
    header('location:login_form.php');
    exit();
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "SELECT * FROM user_form WHERE id = $id";
    $result = mysqli_query($conn, $query);
    $user = mysqli_fetch_assoc($result);
}

if (isset($_POST['update'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $user_type = $_POST['user_type'];

    $update_query = "UPDATE user_form SET name = '$name', email = '$email', user_type = '$user_type' WHERE id = $id";
    mysqli_query($conn, $update_query);
    header('location:admin_page.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Muuda Kasutajat</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<h2>Muuda kasutajat</h2>
<form action="" method="post">
    <input type="text" name="name" value="<?php echo $user['name']; ?>" required>
    <input type="email" name="email" value="<?php echo $user['email']; ?>" required>
    <select name="user_type">
        <option value="user" <?php if ($user['user_type'] == 'user') echo 'selected'; ?>>User</option>
        <option value="admin" <?php if ($user['user_type'] == 'admin') echo 'selected'; ?>>Admin</option>
    </select>
    <input type="submit" name="update" value="Uuenda">
</form>

<a href="admin_page.php">Tagasi</a>

</body>
</html>
