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

$patients = $conn->query(
    "SELECT patient_id, first_name, last_name
     FROM patients
     ORDER BY first_name"
);

$doctors = $conn->query(
    "SELECT doctor_id, doctor_name, specialization
     FROM doctors
     ORDER BY doctor_name"
);

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/jpeg" href="images/logo.jpeg">
    <link rel="stylesheet" href="css/style.css">
    <title>Viweka Hospital | Appointment Management</title>
</head>

<body>
<?php include __DIR__ . '/includes/header.php'; ?>
<main class="page-wrapper">

<h1>Appointment Management</h1>

<h2>Book Appointment</h2>

<form action="book_appointment.php" method="POST">

    Patient:<br>

    <select name="patient_id" required>

        <option value="">Select Patient</option>

        <?php while ($patient = $patients->fetch_assoc()) { ?>

            <option value="<?php echo $patient['patient_id']; ?>">

                <?php
                echo $patient['first_name'] . " "
                   . $patient['last_name'];
                ?>

            </option>

        <?php } ?>

    </select>

    <br><br>


    Doctor:<br>

    <select name="doctor_id" required>

        <option value="">Select Doctor</option>

        <?php while ($doctor = $doctors->fetch_assoc()) { ?>

            <option value="<?php echo $doctor['doctor_id']; ?>">

                <?php
                echo $doctor['doctor_name']
                   . " - "
                   . $doctor['specialization'];
                ?>

            </option>

        <?php } ?>

    </select>

    <br><br>


    Appointment Date:<br>

    <input
        type="date"
        name="appointment_date"
        required
    >

    <br><br>


    Appointment Time:<br>

    <input
        type="time"
        name="appointment_time"
        required
    >

    <br><br>


    <button type="submit">
        Book Appointment
    </button>

</form>

<br>

<a href="view_appointments.php">
    View Appointments
</a>

</main>
<?php include __DIR__ . '/includes/footer.php'; ?>
</body>

</html>