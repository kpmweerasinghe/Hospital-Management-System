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
    'Receptionist'
]);

$sql = "SELECT
            appointments.*,
            patients.first_name,
            patients.last_name,
            doctors.doctor_name

        FROM appointments

        INNER JOIN patients
        ON appointments.patient_id = patients.patient_id

        INNER JOIN doctors
        ON appointments.doctor_id = doctors.doctor_id

        ORDER BY appointment_date, appointment_time";

$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/jpeg" href="images/logo.jpeg">
    <link rel="stylesheet" href="css/style.css">
    <title>Viweka Hospital | Appointments</title>
</head>

<body>
<?php include __DIR__ . '/includes/header.php'; ?>
<main class="page-wrapper">

<h1>Appointment List</h1>

<a href="appointments.php">
    + Book Appointment
</a>

<br><br>

<table border="1" cellpadding="10">

<tr>

    <th>ID</th>
    <th>Patient</th>
    <th>Doctor</th>
    <th>Date</th>
    <th>Time</th>
    <th>Status</th>
    <th>Action</th>

</tr>

<?php while ($row = $result->fetch_assoc()) { ?>

<tr>

    <td>
        <?php echo $row['appointment_id']; ?>
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
        <?php echo $row['appointment_date']; ?>
    </td>

    <td>
        <?php echo $row['appointment_time']; ?>
    </td>

    <td>
        <?php echo $row['status']; ?>
    </td>

<td>

<?php if ($row['status'] == 'Scheduled') { ?>

<a href="edit_appointment.php?id=<?php echo $row['appointment_id']; ?>">
    Reschedule
</a>

|

<a href="cancel_appointment.php?id=<?php echo $row['appointment_id']; ?>"
   onclick="return confirm('Are you sure you want to cancel this appointment?');">
    Cancel
</a>

<?php } else { ?>

No Action

<?php } ?>

</td>
</tr>

<?php } ?>

</table>

</main>
<?php include __DIR__ . '/includes/footer.php'; ?>
</body>

</html>