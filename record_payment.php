<?php

session_start();
include "session_check.php";
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

include "db.php";
include "role_check.php";

require_roles($conn, ['Administrator', 'Accountant']);

$id = $_GET['id'];

$sql = "SELECT
            billing.*,
            patients.first_name,
            patients.last_name

        FROM billing

        INNER JOIN patients
        ON billing.patient_id = patients.patient_id

        WHERE billing.bill_id = $id";

$result = $conn->query($sql);

$bill = $result->fetch_assoc();

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/jpeg" href="images/logo.jpeg">
    <link rel="stylesheet" href="css/style.css">

    <title>Viweka Hospital | Record Payment</title>

</head>

<body>
<?php include __DIR__ . '/includes/header.php'; ?>
<main class="page-wrapper">

<h1>Record Payment</h1>

<p>
    <strong>Patient:</strong>
    <?php
    echo $bill['first_name']
       . " "
       . $bill['last_name'];
    ?>
</p>

<p>
    <strong>Total Amount:</strong>
    <?php echo $bill['total_amount']; ?>
</p>

<form action="save_payment.php" method="POST">

    <input
        type="hidden"
        name="bill_id"
        value="<?php echo $bill['bill_id']; ?>"
    >

    Payment Method:<br>

    <select name="payment_method" required>

        <option value="">
            Select Method
        </option>

        <option value="Cash">
            Cash
        </option>

        <option value="Card">
            Card
        </option>

        <option value="Bank Transfer">
            Bank Transfer
        </option>

    </select>

    <br><br>

    Payment Date:<br>

    <input
        type="date"
        name="payment_date"
        required
    >

    <br><br>

    <button type="submit">
        Record Payment
    </button>

</form>

</main>
<?php include __DIR__ . '/includes/footer.php'; ?>
</body>

</html>