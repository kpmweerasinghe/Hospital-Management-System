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
            audit_logs.log_id,
            users.username,
            audit_logs.action,
            audit_logs.table_name,
            audit_logs.record_id,
            audit_logs.log_time,
            audit_logs.ip_address
        FROM audit_logs
        LEFT JOIN users
        ON audit_logs.user_id = users.user_id
        ORDER BY audit_logs.log_id DESC";

$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/jpeg" href="images/logo.jpeg">
    <link rel="stylesheet" href="css/style.css">
    <title>Viweka Hospital | Audit Logs</title>
</head>

<body>
<?php include __DIR__ . '/includes/header.php'; ?>
<main class="page-wrapper">

<h1>System Audit Logs</h1>

<a href="dashboard.php">Back to Dashboard</a>

<br><br>

<table border="1" cellpadding="10">

<tr>
    <th>ID</th>
    <th>User</th>
    <th>Action</th>
    <th>Table</th>
    <th>Record ID</th>
    <th>Date & Time</th>
    <th>IP Address</th>
</tr>

<?php while ($row = $result->fetch_assoc()) { ?>

<tr>

    <td><?php echo $row['log_id']; ?></td>

    <td><?php echo htmlspecialchars($row['username']); ?></td>

    <td><?php echo htmlspecialchars($row['action']); ?></td>

    <td><?php echo htmlspecialchars($row['table_name']); ?></td>

    <td><?php echo $row['record_id']; ?></td>

    <td><?php echo $row['log_time']; ?></td>

    <td><?php echo $row['ip_address']; ?></td>

</tr>

<?php } ?>

</table>

</main>
<?php include __DIR__ . '/includes/footer.php'; ?>
</body>
</html>