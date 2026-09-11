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

$patients = $conn->query(
    "SELECT patient_id, first_name, last_name
     FROM patients
     ORDER BY first_name"
);

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/jpeg" href="images/logo.jpeg">
    <link rel="stylesheet" href="css/style.css">

    <title>Viweka Hospital | Billing Management</title>

</head>

<body>
<?php include __DIR__ . '/includes/header.php'; ?>
<main class="page-wrapper">

<h1>Billing Management</h1>

<h2>Create Bill</h2>

<form action="add_bill.php" method="POST">

    Patient:<br>

    <select name="patient_id" required>

        <option value="">
            Select Patient
        </option>

        <?php while ($patient = $patients->fetch_assoc()) { ?>

            <option value="<?php echo $patient['patient_id']; ?>">

                <?php
                echo $patient['first_name']
                   . " "
                   . $patient['last_name'];
                ?>

            </option>

        <?php } ?>

    </select>

    <br><br>

    Bill Date:<br>

    <input
        type="date"
        name="bill_date"
        required
    >

    <br><br>

    Consultation Charge:<br>

    <input
        type="number"
        name="consultation_charge"
        step="0.01"
        min="0"
        value="0"
    >

    <br><br>

    Laboratory Charge:<br>

    <input
        type="number"
        name="laboratory_charge"
        step="0.01"
        min="0"
        value="0"
    >

    <br><br>

    Pharmacy Charge:<br>

    <input
        type="number"
        name="pharmacy_charge"
        step="0.01"
        min="0"
        value="0"
    >

    <br><br>

    Admission Charge:<br>

    <input
        type="number"
        name="admission_charge"
        step="0.01"
        min="0"
        value="0"
    >

    <br><br>

    <button type="submit">
        Create Bill
    </button>

</form>

<br>

<a href="view_bills.php">
    View Bills
</a>

</main>
<?php include __DIR__ . '/includes/footer.php'; ?>
</body>

</html>