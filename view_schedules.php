<?php

session_start();

include "session_check.php";
include "db.php";
include "role_check.php";

require_roles($conn, [
    'Administrator',
    'Doctor'
]);

// Get all doctor schedules
$sql = "SELECT
            doctor_schedules.schedule_id,
            doctors.doctor_name,
            doctors.specialization,
            departments.department_name,
            doctor_schedules.day_of_week,
            doctor_schedules.start_time,
            doctor_schedules.end_time

        FROM doctor_schedules

        INNER JOIN doctors
        ON doctor_schedules.doctor_id = doctors.doctor_id

        LEFT JOIN departments
        ON doctors.department_id = departments.department_id

        ORDER BY
            doctors.doctor_name,
            doctor_schedules.day_of_week,
            doctor_schedules.start_time";

$result = $conn->query($sql);

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

<h1>Doctor Schedule Management</h1>

<a href="dashboard.php">Back to Dashboard</a>

<br><br>

<a href="doctor_schedule.php">
    + Add Doctor Schedule
</a>

<br><br>

<?php

if ($result->num_rows > 0) {

?>

<table border="1" cellpadding="10" cellspacing="0">

    <tr>

        <th>Schedule ID</th>
        <th>Doctor</th>
        <th>Specialization</th>
        <th>Department</th>
        <th>Day</th>
        <th>Start Time</th>
        <th>End Time</th>

    </tr>

<?php

while ($row = $result->fetch_assoc()) {

?>

    <tr>

        <td>
            <?php echo $row['schedule_id']; ?>
        </td>

        <td>
            <?php echo htmlspecialchars($row['doctor_name']); ?>
        </td>

        <td>
            <?php echo htmlspecialchars($row['specialization']); ?>
        </td>

        <td>
            <?php echo htmlspecialchars($row['department_name']); ?>
        </td>

        <td>
            <?php echo htmlspecialchars($row['day_of_week']); ?>
        </td>

        <td>
            <?php echo date("h:i A", strtotime($row['start_time'])); ?>
        </td>

        <td>
            <?php echo date("h:i A", strtotime($row['end_time'])); ?>
        </td>

    </tr>

<?php

}

?>

</table>

<?php

} else {

    echo "<p>No doctor schedules found.</p>";

}

?>

<br>

<a href="dashboard.php">Back to Dashboard</a>

</main>
<?php include __DIR__ . '/includes/footer.php'; ?>
</body>

</html>