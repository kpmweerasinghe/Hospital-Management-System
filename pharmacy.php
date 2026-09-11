<?php

session_start();
include "session_check.php";
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

include "db.php";
include "role_check.php";

require_roles($conn, ['Administrator', 'Pharmacist']);

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/jpeg" href="images/logo.jpeg">
    <link rel="stylesheet" href="css/style.css">

    <title>Viweka Hospital | Pharmacy Management</title>

</head>

<body>
<?php include __DIR__ . '/includes/header.php'; ?>
<main class="page-wrapper">

<h1>Pharmacy Management</h1>

<h2>Add Medicine</h2>

<form action="add_medicine.php" method="POST">

    Medicine Name:<br>

    <input
        type="text"
        name="medicine_name"
        required
    >

    <br><br>

    Category:<br>

    <input
        type="text"
        name="category"
        placeholder="Example: Antibiotic"
    >

    <br><br>

    Quantity:<br>

    <input
        type="number"
        name="quantity"
        min="0"
        required
    >

    <br><br>

    Unit Price:<br>

    <input
        type="number"
        name="unit_price"
        step="0.01"
        min="0"
        required
    >

    <br><br>

    Expiry Date:<br>

    <input
        type="date"
        name="expiry_date"
        required
    >

    <br><br>

    <button type="submit">
        Add Medicine
    </button>

</form>

<br>

<a href="view_medicines.php">
    View Medicine Inventory
</a>

</main>
<?php include __DIR__ . '/includes/footer.php'; ?>
</body>

</html>