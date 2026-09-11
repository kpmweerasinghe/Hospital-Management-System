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

$patients = $conn->query(
    "SELECT patient_id, first_name, last_name
     FROM patients
     ORDER BY first_name"
);

$medicines = $conn->query(
    "SELECT medicine_id, medicine_name, quantity
     FROM medicines
     WHERE quantity > 0
     ORDER BY medicine_name"
);

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/jpeg" href="images/logo.jpeg">
    <link rel="stylesheet" href="css/style.css">

    <title>Viweka Hospital | Prescription Processing</title>

</head>

<body>
<?php include __DIR__ . '/includes/header.php'; ?>
<main class="page-wrapper">

<h1>Prescription Processing</h1>

<form action="process_prescription.php" method="POST">

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

    Medicine:<br>

    <select name="medicine_id" required>

        <option value="">
            Select Medicine
        </option>

        <?php while ($medicine = $medicines->fetch_assoc()) { ?>

            <option value="<?php echo $medicine['medicine_id']; ?>">

                <?php
                echo $medicine['medicine_name']
                   . " (Stock: "
                   . $medicine['quantity']
                   . ")";
                ?>

            </option>

        <?php } ?>

    </select>

    <br><br>

    Quantity:<br>

    <input
        type="number"
        name="quantity"
        min="1"
        required
    >

    <br><br>

    Prescription Date:<br>

    <input
        type="date"
        name="prescription_date"
        required
    >

    <br><br>

    <button type="submit">
        Process Prescription
    </button>

</form>

<br>

<a href="view_prescriptions.php">
    View Prescriptions
</a>

</main>
<?php include __DIR__ . '/includes/footer.php'; ?>
</body>

</html>