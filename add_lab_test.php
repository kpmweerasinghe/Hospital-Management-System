<?php

include "db.php";
include_once "includes/response.php";

$patient_id = $_POST['patient_id'];
$doctor_id = $_POST['doctor_id'];
$test_name = $_POST['test_name'];
$requested_date = $_POST['requested_date'];

$sql = "INSERT INTO laboratory_tests
        (patient_id, doctor_id, test_name, requested_date)
        VALUES
        ('$patient_id',
         '$doctor_id',
         '$test_name',
         '$requested_date')";

if ($conn->query($sql) === TRUE) {

    render_response('success', 'Laboratory Test Requested Successfully', '', [
        'laboratory.php' => 'Request Another Test',
        'view_lab_tests.php' => 'View Laboratory Tests',
    ]);

} else {

    render_response('error', 'Something Went Wrong', 'Error: ' . $conn->error, [
        'laboratory.php' => 'Back',
    ]);

}

?>