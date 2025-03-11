<?php
@include 'config.php';
session_start();

if (!isset($_SESSION['admin_name'])) {
    header('location:login_form.php');
    exit();
}

if (isset($_GET['delete'])) {
    $delete_id = $_GET['delete'];
    $delete_query = "DELETE FROM user_form WHERE id = $delete_id";
    mysqli_query($conn, $delete_query);
    header('location:admin_page.php');
}

$select_users = "SELECT * FROM user_form";
$result = mysqli_query($conn, $select_users);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Page</title>
    <link rel="stylesheet" href="styles.css">

</head>
<body>

<h2>Administraatori leht</h2>
<table border="1">
    <tr>
        <th>ID</th>
        <th>Nimi</th>
        <th>Email</th>
        <th>Kasutaja tüüp</th>
        <th>Tegevused</th>
    </tr>
    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
    <tr>
        <td><?php echo $row['id']; ?></td>
        <td><?php echo $row['name']; ?></td>
        <td><?php echo $row['email']; ?></td>
        <td><?php echo $row['user_type']; ?></td>
        <td>
            <a href="edit_user.php?id=<?php echo $row['id']; ?>">Muuda</a>
            <a href="admin_page.php?delete=<?php echo $row['id']; ?>" onclick="return confirm('Kas oled kindel?')">Kustuta</a>
        </td>
    </tr>
    <?php } ?>
</table>


<form action="logout.php" method="get">
    <button type="submit">Logi välja</button>
</form>

<form action="index.php" method="get">
    <button type="submit">Tagasi avalehele</button>
</form>

</body>
</html>
