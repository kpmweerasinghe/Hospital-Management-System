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

$id = $_POST['patient_id'];

$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$dob = $_POST['dob'];
$gender = $_POST['gender'];
$phone = $_POST['phone'];
$email = $_POST['email'];
$address = $_POST['address'];
$blood_group = $_POST['blood_group'];

$sql = "UPDATE patients SET

first_name = '$first_name',
last_name = '$last_name',
dob = '$dob',
gender = '$gender',
phone = '$phone',
email = '$email',
address = '$address',
blood_group = '$blood_group'

WHERE patient_id = $id";

if ($conn->query($sql) === TRUE) {

    render_response('success', 'Patient Updated Successfully', '', [
        'view_patients.php' => 'Back to Patient List',
    ]);

} else {

    render_response('error', 'Something Went Wrong', 'Error: ' . $conn->error, [
        'view_patients.php' => 'Back',
    ]);

}

?>