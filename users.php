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

$roles = $conn->query(
    "SELECT role_id, role_name
     FROM roles
     ORDER BY role_name"
);

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/jpeg" href="images/logo.jpeg">
    <link rel="stylesheet" href="css/style.css">

    <title>Viweka Hospital | User Management</title>

</head>

<body>
<?php include __DIR__ . '/includes/header.php'; ?>
<main class="page-wrapper">

<h1>User Management</h1>

<h2>Create User</h2>

<form action="add_user.php" method="POST">

    Username:<br>

    <input
        type="text"
        name="username"
        required
    >

    <br><br>

    Password:<br>

    <input
        type="password"
        name="password"
        required
    >

    <br><br>

    Role:<br>

    <select name="role_id" required>

        <option value="">
            Select Role
        </option>

        <?php while ($role = $roles->fetch_assoc()) { ?>

            <option value="<?php echo $role['role_id']; ?>">

                <?php echo $role['role_name']; ?>

            </option>

        <?php } ?>

    </select>

    <br><br>

    Status:<br>

    <select name="status">

        <option value="Active">
            Active
        </option>

        <option value="Inactive">
            Inactive
        </option>

    </select>

    <br><br>

    <button type="submit">
        Create User
    </button>

</form>

<br>

<a href="view_users.php">
    View Users
</a>

</main>
<?php include __DIR__ . '/includes/footer.php'; ?>
</body>

</html>