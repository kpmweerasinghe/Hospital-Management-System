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

$id = $_GET['id'];

$sql = "SELECT
            laboratory_tests.*,
            patients.first_name,
            patients.last_name,
            patients.dob,
            patients.gender,
            doctors.doctor_name

        FROM laboratory_tests

        INNER JOIN patients
        ON laboratory_tests.patient_id = patients.patient_id

        INNER JOIN doctors
        ON laboratory_tests.doctor_id = doctors.doctor_id

        WHERE laboratory_tests.test_id = $id";

$result = $conn->query($sql);

$test = $result->fetch_assoc();

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

<h1>Viweka Hospital Management System</h1>

<h2>Laboratory Report</h2>

<hr>

<p>
    <strong>Test ID:</strong>
    <?php echo $test['test_id']; ?>
</p>

<p>
    <strong>Patient Name:</strong>
    <?php
    echo $test['first_name'] . " " . $test['last_name'];
    ?>
</p>

<p>
    <strong>Date of Birth:</strong>
    <?php echo $test['dob']; ?>
</p>

<p>
    <strong>Gender:</strong>
    <?php echo $test['gender']; ?>
</p>

<p>
    <strong>Doctor:</strong>
    <?php echo $test['doctor_name']; ?>
</p>

<p>
    <strong>Test Name:</strong>
    <?php echo $test['test_name']; ?>
</p>

<p>
    <strong>Requested Date:</strong>
    <?php echo $test['requested_date']; ?>
</p>

<p>
    <strong>Result Date:</strong>
    <?php echo $test['result_date']; ?>
</p>

<hr>

<h3>Laboratory Result</h3>

<p>
    <?php echo nl2br($test['result']); ?>
</p>

<hr>

<p>
    <strong>Status:</strong>
    <?php echo $test['test_status']; ?>
</p>

<br>

<button onclick="window.print()">
    Print Report
</button>

<br><br>

<a href="view_lab_tests.php">
    Back to Laboratory Tests
</a>

</main>
<?php include __DIR__ . '/includes/footer.php'; ?>
</body>

</html>