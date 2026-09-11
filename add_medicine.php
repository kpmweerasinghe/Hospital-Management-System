<?php

include "db.php";
include_once "includes/response.php";

$medicine_name = $_POST['medicine_name'];
$category = $_POST['category'];
$quantity = $_POST['quantity'];
$unit_price = $_POST['unit_price'];
$expiry_date = $_POST['expiry_date'];

$sql = "INSERT INTO medicines
        (medicine_name, category, quantity, unit_price, expiry_date)
        VALUES
        ('$medicine_name',
         '$category',
         '$quantity',
         '$unit_price',
         '$expiry_date')";

if ($conn->query($sql) === TRUE) {

    render_response('success', 'Medicine Added Successfully', '', [
        'pharmacy.php' => 'Add Another Medicine',
        'view_medicines.php' => 'View Medicine Inventory',
    ]);

} else {

    render_response('error', 'Something Went Wrong', 'Error: ' . $conn->error, [
        'pharmacy.php' => 'Back',
    ]);

}

?>