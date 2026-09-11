<?php

session_start();
include "session_check.php";
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

include "db.php";
include "role_check.php";

require_roles($conn, [
    'Administrator',
    'Doctor',
    'Lab Staff'
]);

$sql = "SELECT
            laboratory_tests.*,
            patients.first_name,
            patients.last_name,
            doctors.doctor_name

        FROM laboratory_tests

        INNER JOIN patients
        ON laboratory_tests.patient_id = patients.patient_id

        INNER JOIN doctors
        ON laboratory_tests.doctor_id = doctors.doctor_id

        ORDER BY requested_date DESC";

$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/jpeg" href="images/logo.jpeg">
    <link rel="stylesheet" href="css/style.css">

    <title>Viweka Hospital | Laboratory Report</title>

</head>

<body>
<?php include __DIR__ . '/includes/header.php'; ?>
<main class="page-wrapper">

<h1>Laboratory Report</h1>

<table border="1" cellpadding="10">

<tr>

    <th>ID</th>
    <th>Patient</th>
    <th>Doctor</th>
    <th>Test</th>
    <th>Sample Status</th>
    <th>Test Status</th>
    <th>Requested Date</th>
    <th>Result Date</th>

</tr>

<?php while ($row = $result->fetch_assoc()) { ?>

<tr>

    <td><?php echo $row['test_id']; ?></td>

    <td>
        <?php
        echo $row['first_name']
           . " "
           . $row['last_name'];
        ?>
    </td>

    <td><?php echo $row['doctor_name']; ?></td>

    <td><?php echo $row['test_name']; ?></td>

    <td><?php echo $row['sample_status']; ?></td>

    <td><?php echo $row['test_status']; ?></td>

    <td><?php echo $row['requested_date']; ?></td>

    <td><?php echo $row['result_date']; ?></td>

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