<?php

session_start();
include "session_check.php";
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

include "db.php";
include "role_check.php";

require_roles($conn, ['Administrator', 'Accountant']);

$id = $_GET['id'];

$sql = "SELECT
            billing.*,
            patients.first_name,
            patients.last_name,
            patients.phone

        FROM billing

        INNER JOIN patients
        ON billing.patient_id = patients.patient_id

        WHERE billing.bill_id = $id";

$result = $conn->query($sql);

$bill = $result->fetch_assoc();

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/jpeg" href="images/logo.jpeg">
    <link rel="stylesheet" href="css/style.css">

    <title>Viweka Hospital | Hospital Invoice</title>

</head>

<body>
<?php include __DIR__ . '/includes/header.php'; ?>
<main class="page-wrapper">

<h1>Viweka Hospital Management System</h1>

<h2>Invoice</h2>

<hr>

<p>
    <strong>Invoice No:</strong>
    <?php echo $bill['bill_id']; ?>
</p>

<p>
    <strong>Patient:</strong>
    <?php
    echo $bill['first_name']
       . " "
       . $bill['last_name'];
    ?>
</p>

<p>
    <strong>Phone:</strong>
    <?php echo $bill['phone']; ?>
</p>

<p>
    <strong>Date:</strong>
    <?php echo $bill['bill_date']; ?>
</p>

<hr>

<table border="1" cellpadding="10">

<tr>
    <th>Description</th>
    <th>Amount</th>
</tr>

<tr>
    <td>Consultation Charge</td>
    <td><?php echo $bill['consultation_charge']; ?></td>
</tr>

<tr>
    <td>Laboratory Charge</td>
    <td><?php echo $bill['laboratory_charge']; ?></td>
</tr>

<tr>
    <td>Pharmacy Charge</td>
    <td><?php echo $bill['pharmacy_charge']; ?></td>
</tr>

<tr>
    <td>Admission Charge</td>
    <td><?php echo $bill['admission_charge']; ?></td>
</tr>

<tr>
    <th>Total Amount</th>
    <th><?php echo $bill['total_amount']; ?></th>
</tr>

</table>

<br>

<strong>
    Payment Status:
    <?php echo $bill['payment_status']; ?>
</strong>

<br><br>

<button onclick="window.print()">
    Print Invoice
</button>

<br><br>

<a href="view_bills.php">
    Back to Bills
</a>

</main>
<?php include __DIR__ . '/includes/footer.php'; ?>
</body>

</html>