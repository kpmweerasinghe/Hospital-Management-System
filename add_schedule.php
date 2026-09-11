<?php

session_start();

include "session_check.php";
include "db.php";
include "role_check.php";

require_roles($conn, [
    'Administrator'
]);

include_once "includes/response.php";

// Get form data
$doctor_id = $_POST['doctor_id'];
$day_of_week = $_POST['day_of_week'];
$start_time = $_POST['start_time'];
$end_time = $_POST['end_time'];

// Validate time
if ($start_time >= $end_time) {
    render_response('error', 'Invalid Schedule', 'Start time must be earlier than end time.', [
        'doctor_schedule.php' => 'Back to Schedule',
    ]);
    exit();
}

// Check whether the doctor already has a schedule
$sql = "SELECT schedule_id
        FROM doctor_schedules
        WHERE doctor_id = ?
        AND day_of_week = ?
        AND start_time = ?
        AND end_time = ?";

$stmt = $conn->prepare($sql);

$stmt->bind_param(
    "isss",
    $doctor_id,
    $day_of_week,
    $start_time,
    $end_time
);

$stmt->execute();

$result = $stmt->get_result();

if ($result->num_rows > 0) {

    render_response('error', 'Schedule Already Exists', 'This doctor already has the same schedule.', [
        'doctor_schedule.php' => 'Back to Schedule',
    ]);
    exit();

}

// Insert schedule
$sql = "INSERT INTO doctor_schedules
        (doctor_id, day_of_week, start_time, end_time)
        VALUES (?, ?, ?, ?)";

$stmt = $conn->prepare($sql);

$stmt->bind_param(
    "isss",
    $doctor_id,
    $day_of_week,
    $start_time,
    $end_time
);

if ($stmt->execute()) {

    $schedule_id = $conn->insert_id;

    render_response('success', 'Doctor Schedule Added Successfully', 'Schedule ID: ' . $schedule_id, [
        'doctor_schedule.php' => 'Add Another Schedule',
        'view_schedules.php' => 'View Doctor Schedules',
        'dashboard.php' => 'Back to Dashboard',
    ]);

} else {

    render_response('error', 'Something Went Wrong', 'Error: ' . $conn->error, [
        'doctor_schedule.php' => 'Back',
    ]);

}

?>