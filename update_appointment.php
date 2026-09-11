<?php

include "db.php";
include "role_check.php";

require_roles($conn, [
    'Administrator',
    'Doctor',
    'Receptionist'
]);

include_once "includes/response.php";

$id = $_POST['appointment_id'];

$date = $_POST['appointment_date'];
$time = $_POST['appointment_time'];

$sql = "UPDATE appointments

        SET appointment_date = '$date',
            appointment_time = '$time',
            status = 'Scheduled'

        WHERE appointment_id = $id";

if ($conn->query($sql) === TRUE) {

    render_response('success', 'Appointment Rescheduled Successfully', '', [
        'view_appointments.php' => 'Back to Appointments',
    ]);

} else {

    render_response('error', 'Something Went Wrong', 'Error: ' . $conn->error, [
        'view_appointments.php' => 'Back',
    ]);

}

?>