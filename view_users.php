<?php

session_start();
include "session_check.php";
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

include "db.php";
include "role_check.php";

require_roles($conn, ['Administrator']);

$sql = "SELECT
            users.user_id,
            users.username,
            users.status,
            roles.role_name

        FROM users

        INNER JOIN roles
        ON users.role_id = roles.role_id

        ORDER BY users.user_id DESC";

$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/jpeg" href="images/logo.jpeg">
    <link rel="stylesheet" href="css/style.css">

    <title>Viweka Hospital | Users</title>

</head>

<body>
<?php include __DIR__ . '/includes/header.php'; ?>
<main class="page-wrapper">

<h1>System Users</h1>

<a href="users.php">
    + Create User
</a>

<br><br>

<table border="1" cellpadding="10">

<tr>

    <th>ID</th>
    <th>Username</th>
    <th>Role</th>
    <th>Status</th>

</tr>

<?php while ($row = $result->fetch_assoc()) { ?>

<tr>

    <td>
        <?php echo $row['user_id']; ?>
    </td>

    <td>
        <?php echo $row['username']; ?>
    </td>

    <td>
        <?php echo $row['role_name']; ?>
    </td>

    <td>
        <?php echo $row['status']; ?>
    </td>

</tr>

<?php } ?>

</table>

</main>
<?php include __DIR__ . '/includes/footer.php'; ?>
</body>

</html>