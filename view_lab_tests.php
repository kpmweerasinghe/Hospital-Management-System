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

        ORDER BY laboratory_tests.test_id DESC";

$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/jpeg" href="images/logo.jpeg">
    <link rel="stylesheet" href="css/style.css">

    <title>Viweka Hospital | Laboratory Tests</title>

</head>

<body>
<?php include __DIR__ . '/includes/header.php'; ?>
<main class="page-wrapper">

<h1>Laboratory Tests</h1>

<a href="laboratory.php">
    + Request Laboratory Test
</a>

<br><br>

<table border="1" cellpadding="10">

<tr>

    <th>ID</th>
    <th>Patient</th>
    <th>Doctor</th>
    <th>Test Name</th>
    <th>Sample Status</th>
    <th>Test Status</th>
    <th>Requested Date</th>
    <th>Result</th>
    <th>Action</th>

</tr>

<?php while ($row = $result->fetch_assoc()) { ?>

<tr>

    <td>
        <?php echo $row['test_id']; ?>
    </td>

    <td>
        <?php
        echo $row['first_name']
           . " "
           . $row['last_name'];
        ?>
    </td>

    <td>
        <?php echo $row['doctor_name']; ?>
    </td>

    <td>
        <?php echo $row['test_name']; ?>
    </td>

    <td>
        <?php echo $row['sample_status']; ?>
    </td>

    <td>
        <?php echo $row['test_status']; ?>
    </td>

    <td>
        <?php echo $row['requested_date']; ?>
    </td>

    <td>
        <?php echo $row['result']; ?>
    </td>
<td>

    <?php if ($row['sample_status'] == 'Pending') { ?>

        <a href="collect_sample.php?id=<?php echo $row['test_id']; ?>">
            Collect Sample
        </a>

    <?php } elseif ($row['test_status'] == 'Sample Collected') { ?>

        <a href="enter_lab_result.php?id=<?php echo $row['test_id']; ?>">
            Enter Result
        </a>

    <?php } elseif ($row['test_status'] == 'Result Ready') { ?>

        <a href="lab_report.php?id=<?php echo $row['test_id']; ?>">
            View Report
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