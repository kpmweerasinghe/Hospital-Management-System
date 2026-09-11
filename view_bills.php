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

$sql = "SELECT
            billing.*,
            patients.first_name,
            patients.last_name

        FROM billing

        INNER JOIN patients
        ON billing.patient_id = patients.patient_id

        ORDER BY billing.bill_id DESC";

$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/jpeg" href="images/logo.jpeg">
    <link rel="stylesheet" href="css/style.css">

    <title>Viweka Hospital | View Bills</title>

</head>

<body>
<?php include __DIR__ . '/includes/header.php'; ?>
<main class="page-wrapper">

<h1>Billing Records</h1>

<a href="billing.php">
    + Create New Bill
</a>

<br><br>

<table border="1" cellpadding="10">

<tr>

    <th>Bill ID</th>
    <th>Patient</th>
    <th>Date</th>
    <th>Consultation</th>
    <th>Laboratory</th>
    <th>Pharmacy</th>
    <th>Admission</th>
    <th>Total</th>
    <th>Payment Status</th>
    <th>Action</th>

</tr>

<?php while ($row = $result->fetch_assoc()) { ?>

<tr>

    <td>
        <?php echo $row['bill_id']; ?>
    </td>

    <td>
        <?php
        echo $row['first_name']
           . " "
           . $row['last_name'];
        ?>
    </td>

    <td>
        <?php echo $row['bill_date']; ?>
    </td>

    <td>
        <?php echo $row['consultation_charge']; ?>
    </td>

    <td>
        <?php echo $row['laboratory_charge']; ?>
    </td>

    <td>
        <?php echo $row['pharmacy_charge']; ?>
    </td>

    <td>
        <?php echo $row['admission_charge']; ?>
    </td>

    <td>
        <?php echo $row['total_amount']; ?>
    </td>

    <td>
        <?php echo $row['payment_status']; ?>
    </td>

    <td>

        <a href="invoice.php?id=<?php echo $row['bill_id']; ?>">
            Invoice
        </a>

        <?php if ($row['payment_status'] == 'Pending') { ?>

            |
            <a href="record_payment.php?id=<?php echo $row['bill_id']; ?>">
                Record Payment
            </a>

        <?php } ?>

    </td>

</tr>

<?php } ?>

</table>

</main>
<?php include __DIR__ . '/includes/footer.php'; ?>
</body>

</html>