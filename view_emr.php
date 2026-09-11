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
    'Nurse'
]);

$sql = "SELECT
            medical_records.*,
            patients.first_name,
            patients.last_name,
            doctors.doctor_name

        FROM medical_records

        INNER JOIN patients
        ON medical_records.patient_id = patients.patient_id

        INNER JOIN doctors
        ON medical_records.doctor_id = doctors.doctor_id

        ORDER BY visit_date DESC";

$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/jpeg" href="images/logo.jpeg">
    <link rel="stylesheet" href="css/style.css">
    <title>Viweka Hospital | Medical Records</title>
</head>

<body>
<?php include __DIR__ . '/includes/header.php'; ?>
<main class="page-wrapper">

<h1>Medical Records</h1>

<a href="emr.php">
    + Add Medical Record
</a>

<br><br>

<table border="1" cellpadding="10">

<tr>

    <th>ID</th>
    <th>Patient</th>
    <th>Doctor</th>
    <th>Visit Date</th>
    <th>Diagnosis</th>
    <th>Treatment</th>
    <th>Prescription</th>

</tr>

<?php while ($row = $result->fetch_assoc()) { ?>

<tr>

    <td>
        <?php echo $row['record_id']; ?>
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
        <?php echo $row['visit_date']; ?>
    </td>

    <td>
        <?php echo $row['diagnosis']; ?>
    </td>

    <td>
        <?php echo $row['treatment']; ?>
    </td>

    <td>
        <?php echo $row['prescription']; ?>
    </td>

</tr>

<?php } ?>

</table>

</main>
<?php include __DIR__ . '/includes/footer.php'; ?>
</body>

</html>