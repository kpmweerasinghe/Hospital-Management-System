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

$sql = "SELECT
            pharmacy_prescriptions.*,
            patients.first_name,
            patients.last_name,
            medicines.medicine_name

        FROM pharmacy_prescriptions

        INNER JOIN patients
        ON pharmacy_prescriptions.patient_id = patients.patient_id

        INNER JOIN medicines
        ON pharmacy_prescriptions.medicine_id = medicines.medicine_id

        ORDER BY prescription_id DESC";

$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/jpeg" href="images/logo.jpeg">
    <link rel="stylesheet" href="css/style.css">

    <title>Viweka Hospital | Prescriptions</title>

</head>

<body>
<?php include __DIR__ . '/includes/header.php'; ?>
<main class="page-wrapper">

<h1>Pharmacy Prescriptions</h1>

<a href="prescriptions.php">
    + Process Prescription
</a>

<br><br>

<table border="1" cellpadding="10">

<tr>

    <th>ID</th>
    <th>Patient</th>
    <th>Medicine</th>
    <th>Quantity</th>
    <th>Date</th>
    <th>Status</th>

</tr>

<?php while ($row = $result->fetch_assoc()) { ?>

<tr>

    <td><?php echo $row['prescription_id']; ?></td>

    <td>
        <?php
        echo $row['first_name']
           . " "
           . $row['last_name'];
        ?>
    </td>

    <td><?php echo $row['medicine_name']; ?></td>

    <td><?php echo $row['quantity']; ?></td>

    <td><?php echo $row['prescription_date']; ?></td>

    <td><?php echo $row['status']; ?></td>

</tr>

<?php } ?>

</table>

</main>
<?php include __DIR__ . '/includes/footer.php'; ?>
</body>

</html>