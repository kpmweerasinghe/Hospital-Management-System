<?php

session_start();
include "session_check.php";
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

include "db.php";

$id = $_GET['id'];

$sql = "SELECT * FROM medicines
        WHERE medicine_id = $id";

$result = $conn->query($sql);

$medicine = $result->fetch_assoc();

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/jpeg" href="images/logo.jpeg">
    <link rel="stylesheet" href="css/style.css">

    <title>Viweka Hospital | Edit Medicine</title>

</head>

<body>
<?php include __DIR__ . '/includes/header.php'; ?>
<main class="page-wrapper">

<h1>Edit Medicine</h1>

<form action="update_medicine.php" method="POST">

    <input
        type="hidden"
        name="medicine_id"
        value="<?php echo $medicine['medicine_id']; ?>"
    >

    Medicine Name:<br>

    <input
        type="text"
        name="medicine_name"
        value="<?php echo $medicine['medicine_name']; ?>"
        required
    >

    <br><br>

    Category:<br>

    <input
        type="text"
        name="category"
        value="<?php echo $medicine['category']; ?>"
    >

    <br><br>

    Quantity:<br>

    <input
        type="number"
        name="quantity"
        value="<?php echo $medicine['quantity']; ?>"
        min="0"
        required
    >

    <br><br>

    Unit Price:<br>

    <input
        type="number"
        name="unit_price"
        value="<?php echo $medicine['unit_price']; ?>"
        step="0.01"
        min="0"
        required
    >

    <br><br>

    Expiry Date:<br>

    <input
        type="date"
        name="expiry_date"
        value="<?php echo $medicine['expiry_date']; ?>"
        required
    >

    <br><br>

    <button type="submit">
        Update Medicine
    </button>

</form>

</main>
<?php include __DIR__ . '/includes/footer.php'; ?>
</body>

</html>