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
    <title>Viweka Hospital | Doctor Schedules</title>
</head>
<body>
<?php include __DIR__ . '/includes/header.php'; ?>
<main class="page-wrapper">

<h1>Add Doctor Schedule</h1>

<form action="add_schedule.php" method="POST">

    Doctor:<br>

    <select name="doctor_id" required>

        <?php

        include "db.php";

        $doctors = $conn->query(
            "SELECT doctor_id, doctor_name
             FROM doctors
             ORDER BY doctor_name"
        );

        while ($doctor = $doctors->fetch_assoc()) {

        ?>

            <option value="<?php echo $doctor['doctor_id']; ?>">
                <?php echo htmlspecialchars($doctor['doctor_name']); ?>
            </option>

        <?php } ?>

    </select>

    <br><br>

    Day:<br>

    <select name="day_of_week" required>
        <option>Monday</option>
        <option>Tuesday</option>
        <option>Wednesday</option>
        <option>Thursday</option>
        <option>Friday</option>
        <option>Saturday</option>
        <option>Sunday</option>
    </select>

    <br><br>

    Start Time:<br>
    <input type="time" name="start_time" required>

    <br><br>

    End Time:<br>
    <input type="time" name="end_time" required>

    <br><br>

    <button type="submit">Add Schedule</button>

</form>

<a href="view_schedules.php">View Doctor Schedules</a><br>
<a href="dashboard.php">Back to Dashboard</a>

</main>
<?php include __DIR__ . '/includes/footer.php'; ?>
</body>
</html>