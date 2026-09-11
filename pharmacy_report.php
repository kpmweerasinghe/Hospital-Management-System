<?php

session_start();
include "session_check.php";
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

include "db.php";

$sql = "SELECT *
        FROM medicines
        ORDER BY quantity ASC";

$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/jpeg" href="images/logo.jpeg">
    <link rel="stylesheet" href="css/style.css">

    <title>Viweka Hospital | Pharmacy Report</title>

</head>

<body>
<?php include __DIR__ . '/includes/header.php'; ?>
<main class="page-wrapper">

<h1>Pharmacy Inventory Report</h1>

<table border="1" cellpadding="10">

<tr>

    <th>ID</th>
    <th>Medicine</th>
    <th>Category</th>
    <th>Quantity</th>
    <th>Unit Price</th>
    <th>Expiry Date</th>

</tr>

<?php while ($row = $result->fetch_assoc()) { ?>

<tr>

    <td><?php echo $row['medicine_id']; ?></td>
    <td><?php echo $row['medicine_name']; ?></td>
    <td><?php echo $row['category']; ?></td>
    <td><?php echo $row['quantity']; ?></td>
    <td><?php echo $row['unit_price']; ?></td>
    <td><?php echo $row['expiry_date']; ?></td>

</tr>

<?php } ?>

</table>

<br>

<button onclick="window.print()">
    Print Report
</button>

<br><br>

<a href="reports.php">
    Back to Reports
</a>

</main>
<?php include __DIR__ . '/includes/footer.php'; ?>
</body>

</html>