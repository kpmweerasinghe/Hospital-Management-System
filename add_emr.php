<?php

include "db.php";
include "role_check.php";
include_once "includes/response.php";

require_roles($conn, [
    'Administrator',
    'Doctor',
    'Nurse'
]);

$patient_id = $_POST['patient_id'];
$doctor_id = $_POST['doctor_id'];
$visit_date = $_POST['visit_date'];
$diagnosis = $_POST['diagnosis'];
$treatment = $_POST['treatment'];
$prescription = $_POST['prescription'];

$sql = "INSERT INTO medical_records
        (patient_id, doctor_id, diagnosis, treatment,
         prescription, visit_date)

        VALUES
        ('$patient_id',
         '$doctor_id',
         '$diagnosis',
         '$treatment',
         '$prescription',
         '$visit_date')";

if ($conn->query($sql) === TRUE) {

    render_response('success', 'Medical Record Saved Successfully', '', [
        'emr.php' => 'Add Another Record',
        'view_emr.php' => 'View Medical Records',
    ]);

} else {

    render_response('error', 'Something Went Wrong', 'Error: ' . $conn->error, [
        'emr.php' => 'Back',
    ]);

}

?>