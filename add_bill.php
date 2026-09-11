<?php

include "db.php";
include_once "includes/response.php";

$patient_id = $_POST['patient_id'];
$bill_date = $_POST['bill_date'];

$consultation_charge = $_POST['consultation_charge'];
$laboratory_charge = $_POST['laboratory_charge'];
$pharmacy_charge = $_POST['pharmacy_charge'];
$admission_charge = $_POST['admission_charge'];

$total_amount =
    $consultation_charge +
    $laboratory_charge +
    $pharmacy_charge +
    $admission_charge;

$sql = "INSERT INTO billing
        (
            patient_id,
            bill_date,
            consultation_charge,
            laboratory_charge,
            pharmacy_charge,
            admission_charge,
            total_amount
        )

        VALUES
        (
            '$patient_id',
            '$bill_date',
            '$consultation_charge',
            '$laboratory_charge',
            '$pharmacy_charge',
            '$admission_charge',
            '$total_amount'
        )";

if ($conn->query($sql) === TRUE) {

    render_response('success', 'Bill Created Successfully', '', [
        'billing.php' => 'Create Another Bill',
        'view_bills.php' => 'View Bills',
    ]);

} else {

    render_response('error', 'Something Went Wrong', 'Error: ' . $conn->error, [
        'billing.php' => 'Back',
    ]);

}

?>