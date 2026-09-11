<?php

include "db.php";
include "role_check.php";

require_roles($conn, ['Administrator', 'Accountant']);

include_once "includes/response.php";

$bill_id = $_POST['bill_id'];
$payment_method = $_POST['payment_method'];
$payment_date = $_POST['payment_date'];

$sql = "UPDATE billing

        SET payment_status = 'Paid',
            payment_method = '$payment_method',
            payment_date = '$payment_date'

        WHERE bill_id = $bill_id";

if ($conn->query($sql) === TRUE) {

    render_response('success', 'Payment Recorded Successfully', '', [
        'view_bills.php' => 'View Bills',
    ]);

} else {

    render_response('error', 'Something Went Wrong', 'Error: ' . $conn->error, [
        'view_bills.php' => 'Back',
    ]);

}

?>