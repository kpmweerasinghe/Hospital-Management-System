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

$id = $_GET['id'];

$sql = "SELECT * FROM appointments
        WHERE appointment_id = $id";

$result = $conn->query($sql);

$appointment = $result->fetch_assoc();

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/jpeg" href="images/logo.jpeg">
    <link rel="stylesheet" href="css/style.css">
    <title>Viweka Hospital | Reschedule Appointment</title>
</head>

<body>
<?php include __DIR__ . '/includes/header.php'; ?>
<main class="page-wrapper">

<h1>Reschedule Appointment</h1>

<form action="update_appointment.php" method="POST">

<input type="hidden"
       name="appointment_id"
       value="<?php echo $appointment['appointment_id']; ?>">

Appointment Date:<br>

<input type="date"
       name="appointment_date"
       value="<?php echo $appointment['appointment_date']; ?>"
       required>

<br><br>

Appointment Time:<br>

<input type="time"
       name="appointment_time"
       value="<?php echo $appointment['appointment_time']; ?>"
       required>

<br><br>

<button type="submit">
    Reschedule Appointment
</button>

</form>

</main>
<?php include __DIR__ . '/includes/footer.php'; ?>
</body>

</html>