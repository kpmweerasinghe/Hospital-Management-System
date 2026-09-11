<?php

session_start();
include "session_check.php";
include "db.php";
include "audit_log.php";
include_once "includes/response.php";

$patient_id = $conn->insert_id;

log_action(
    $conn,
    "Patient registered",
    "patients",
    $patient_id
);

$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$dob = $_POST['dob'];
$gender = $_POST['gender'];
$phone = $_POST['phone'];
$email = $_POST['email'];
$address = $_POST['address'];
$blood_group = $_POST['blood_group'];

$sql = "INSERT INTO patients
(first_name, last_name, dob, gender, phone, email, address, blood_group)
VALUES
('$first_name', '$last_name', '$dob', '$gender', '$phone', '$email', '$address', '$blood_group')";

if ($conn->query($sql) === TRUE) {

    render_response('success', 'Patient Registered Successfully', '', [
        'patients.php' => 'Back to Patients',
    ]);

} else {

    render_response('error', 'Something Went Wrong', 'Error: ' . $conn->error, [
        'patients.php' => 'Back',
    ]);

}

?>