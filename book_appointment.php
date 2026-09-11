<?php

include "db.php";
include "role_check.php";

require_roles($conn, [
    'Administrator',
    'Doctor',
    'Receptionist'
]);

include_once "includes/response.php";

$patient_id = $_POST['patient_id'];
$doctor_id = $_POST['doctor_id'];
$appointment_date = $_POST['appointment_date'];
$appointment_time = $_POST['appointment_time'];

$sql = "INSERT INTO appointments
        (patient_id, doctor_id, appointment_date, appointment_time)
        VALUES
        ('$patient_id',
         '$doctor_id',
         '$appointment_date',
         '$appointment_time')";

if ($conn->query($sql) === TRUE) {

    render_response('success', 'Appointment Booked Successfully', '', [
        'appointments.php' => 'Book Another Appointment',
        'view_appointments.php' => 'View Appointments',
    ]);

} else {

    render_response('error', 'Something Went Wrong', 'Error: ' . $conn->error, [
        'appointments.php' => 'Back',
    ]);

}

?>