<?php

session_start();
include "session_check.php";
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

include "db.php";
include "role_check.php";

require_roles($conn, [
    'Administrator',
    'Doctor',
    'Nurse'
]);

$patients = $conn->query(
    "SELECT patient_id, first_name, last_name
     FROM patients
     ORDER BY first_name"
);

$doctors = $conn->query(
    "SELECT doctor_id, doctor_name
     FROM doctors
     ORDER BY doctor_name"
);

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/jpeg" href="images/logo.jpeg">
    <link rel="stylesheet" href="css/style.css">
    <title>Viweka Hospital | Electronic Medical Records</title>
</head>

<body>
<?php include __DIR__ . '/includes/header.php'; ?>
<main class="page-wrapper">

<h1>Electronic Medical Records</h1>

<h2>Add Medical Record</h2>

<form action="add_emr.php" method="POST">

    Patient:<br>

    <select name="patient_id" required>

        <option value="">Select Patient</option>

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


    Doctor:<br>

    <select name="doctor_id" required>

        <option value="">Select Doctor</option>

        <?php while ($doctor = $doctors->fetch_assoc()) { ?>

            <option value="<?php echo $doctor['doctor_id']; ?>">

                <?php echo $doctor['doctor_name']; ?>

            </option>

        <?php } ?>

    </select>

    <br><br>


    Visit Date:<br>

    <input type="date"
           name="visit_date"
           required>

    <br><br>


    Diagnosis:<br>

    <textarea
        name="diagnosis"
        rows="5"
        cols="50">
    </textarea>

    <br><br>


    Treatment:<br>

    <textarea
        name="treatment"
        rows="5"
        cols="50">
    </textarea>

    <br><br>


    Prescription:<br>

    <textarea
        name="prescription"
        rows="5"
        cols="50">
    </textarea>

    <br><br>


    <button type="submit">
        Save Medical Record
    </button>

</form>

<br>

<a href="view_emr.php">
    View Medical Records
</a>

</main>
<?php include __DIR__ . '/includes/footer.php'; ?>
</body>

</html>