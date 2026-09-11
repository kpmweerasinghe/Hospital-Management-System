<?php

session_start();
include "session_check.php";
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/jpeg" href="images/logo.jpeg">
    <link rel="stylesheet" href="css/style.css">

    <title>Viweka Hospital | Hospital Reports</title>

</head>

<body>
<?php include __DIR__ . '/includes/header.php'; ?>
<main class="page-wrapper">

<h1>Hospital Management Reports</h1>

<h2>Select Report</h2>

<ul>

    <li>
        <a href="patient_report.php">
            Patient Report
        </a>
    </li>

    <li>
        <a href="appointment_report.php">
            Appointment Report
        </a>
    </li>

    <li>
        <a href="revenue_report.php">
            Revenue Report
        </a>
    </li>

    <li>
        <a href="pharmacy_report.php">
            Pharmacy Report
        </a>
    </li>

    <li>
        <a href="laboratory_report.php">
            Laboratory Report
        </a>
    </li>

    <li>
        <a href="staff_report.php">
            Staff/Doctor Report
        </a>
    </li>

</ul>

<br>

<a href="dashboard.php">
    Back to Dashboard
</a>

</main>
<?php include __DIR__ . '/includes/footer.php'; ?>
</body>

</html>