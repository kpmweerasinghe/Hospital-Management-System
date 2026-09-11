<?php

include "db.php";
include "role_check.php";

require_roles($conn, [
    'Administrator',
    'Doctor',
    'Nurse',
    'Receptionist'
]);

include_once "includes/response.php";

$id = $_GET['id'];

$sql = "DELETE FROM patients WHERE patient_id = $id";

if ($conn->query($sql) === TRUE) {

    header("Location: view_patients.php");
    exit();

} else {

    render_response('error', 'Something Went Wrong', 'Error: ' . $conn->error, [
        'view_patients.php' => 'Back',
    ]);

}

?>