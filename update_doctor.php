<?php

include "db.php";
include_once "includes/response.php";

$id = $_POST['doctor_id'];

$doctor_name = $_POST['doctor_name'];
$specialization = $_POST['specialization'];
$phone = $_POST['phone'];
$email = $_POST['email'];
$department_id = $_POST['department_id'];

$sql = "UPDATE doctors SET

doctor_name = '$doctor_name',
specialization = '$specialization',
phone = '$phone',
email = '$email',
department_id = '$department_id'

WHERE doctor_id = $id";

if ($conn->query($sql) === TRUE) {

    render_response('success', 'Doctor Updated Successfully', '', [
        'view_doctors.php' => 'Back to Doctors',
    ]);

} else {

    render_response('error', 'Something Went Wrong', 'Error: ' . $conn->error, [
        'view_doctors.php' => 'Back',
    ]);

}

?>