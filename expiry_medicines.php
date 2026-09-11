<?php

session_start();
include "session_check.php";
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

include "db.php";
include "role_check.php";

require_roles($conn, ['Administrator', 'Pharmacist']);

$sql = "SELECT * FROM medicines
        WHERE expiry_date <= DATE_ADD(CURDATE(), INTERVAL 30 DAY)
        ORDER BY expiry_date ASC";

$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/jpeg" href="images/logo.jpeg">
    <link rel="stylesheet" href="css/style.css">

    <title>Viweka Hospital | Medicine Expiry Monitoring</title>

</head>

<body>
<?php include __DIR__ . '/includes/header.php'; ?>
<main class="page-wrapper">

<h1>Medicine Expiry Monitoring</h1>

<table border="1" cellpadding="10">

<tr>

    <th>ID</th>
    <th>Medicine</th>
    <th>Quantity</th>
    <th>Expiry Date</th>

</tr>

<?php while ($row = $result->fetch_assoc()) { ?>

<tr>

    <td><?php echo $row['medicine_id']; ?></td>

    <td><?php echo $row['medicine_name']; ?></td>

    <td><?php echo $row['quantity']; ?></td>

    <td><?php echo $row['expiry_date']; ?></td>

</tr>

<?php } ?>

</table>

<br>

<a href="view_medicines.php">
    Back to Inventory
</a>

</main>
<?php include __DIR__ . '/includes/footer.php'; ?>
</body>

</html>