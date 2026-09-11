<?php

include "db.php";
include "role_check.php";

require_roles($conn, ['Administrator', 'Pharmacist']);

include_once "includes/response.php";

$patient_id = $_POST['patient_id'];
$medicine_id = $_POST['medicine_id'];
$quantity = $_POST['quantity'];
$prescription_date = $_POST['prescription_date'];

$check = $conn->query(
    "SELECT quantity
     FROM medicines
     WHERE medicine_id = $medicine_id"
);

$medicine = $check->fetch_assoc();

if ($medicine['quantity'] < $quantity) {

    render_response('error', 'Not Enough Medicine Stock', '', [
        'prescriptions.php' => 'Back',
    ]);
    exit();

}

$sql = "INSERT INTO pharmacy_prescriptions
        (patient_id, medicine_id, quantity, prescription_date, status)
        VALUES
        ('$patient_id',
         '$medicine_id',
         '$quantity',
         '$prescription_date',
         'Processed')";

if ($conn->query($sql) === TRUE) {

    $update = "UPDATE medicines
               SET quantity = quantity - $quantity
               WHERE medicine_id = $medicine_id";

    $conn->query($update);

    render_response('success', 'Prescription Processed Successfully', '', [
        'prescriptions.php' => 'Process Another Prescription',
        'view_prescriptions.php' => 'View Prescriptions',
    ]);

} else {

    render_response('error', 'Something Went Wrong', 'Error: ' . $conn->error, [
        'prescriptions.php' => 'Back',
    ]);

}

?>