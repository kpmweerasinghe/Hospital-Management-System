<?php

include "db.php";
include_once "includes/response.php";

$id = $_POST['medicine_id'];

$medicine_name = $_POST['medicine_name'];
$category = $_POST['category'];
$quantity = $_POST['quantity'];
$unit_price = $_POST['unit_price'];
$expiry_date = $_POST['expiry_date'];

$sql = "UPDATE medicines SET

        medicine_name = '$medicine_name',
        category = '$category',
        quantity = '$quantity',
        unit_price = '$unit_price',
        expiry_date = '$expiry_date'

        WHERE medicine_id = $id";

if ($conn->query($sql) === TRUE) {

    header("Location: view_medicines.php");
    exit();

} else {

    render_response('error', 'Something Went Wrong', 'Error: ' . $conn->error, [
        'view_medicines.php' => 'Back',
    ]);

}

?>