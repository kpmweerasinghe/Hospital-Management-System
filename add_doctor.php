<?php

include "db.php";
include_once "includes/response.php";

$doctor_name = $_POST['doctor_name'];
$specialization = $_POST['specialization'];
$phone = $_POST['phone'];
$email = $_POST['email'];
$department_id = $_POST['department_id'];

$sql = "INSERT INTO doctors
        (doctor_name, specialization, phone, email, department_id)
        VALUES
        ('$doctor_name',
         '$specialization',
         '$phone',
         '$email',
         '$department_id')";

if ($conn->query($sql) === TRUE) {

    render_response('success', 'Doctor Registered Successfully', '', [
        'doctors.php' => 'Register Another Doctor',
        'view_doctors.php' => 'View Doctors',
    ]);

} else {

    render_response('error', 'Something Went Wrong', 'Error: ' . $conn->error, [
        'doctors.php' => 'Back',
    ]);

}

?>