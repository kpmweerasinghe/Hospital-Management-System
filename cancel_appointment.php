<?php

include "db.php";
include "role_check.php";

require_roles($conn, [
    'Administrator',
    'Doctor',
    'Receptionist'
]);

include_once "includes/response.php";

$id = $_GET['id'];

$sql = "UPDATE appointments
        SET status = 'Cancelled'
        WHERE appointment_id = $id";

if ($conn->query($sql) === TRUE) {

    header("Location: view_appointments.php");
    exit();

} else {

    render_response('error', 'Something Went Wrong', 'Error: ' . $conn->error, [
        'view_appointments.php' => 'Back',
    ]);

}

?>