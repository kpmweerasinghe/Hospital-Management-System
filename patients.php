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
    'Nurse',
    'Receptionist'
]);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/jpeg" href="images/logo.jpeg">
    <link rel="stylesheet" href="css/style.css">
    <title>Viweka Hospital | Patient Management</title>
</head>

<body>
<?php include __DIR__ . '/includes/header.php'; ?>
<main class="page-wrapper">

<h1>Patient Management</h1>

<h2>Register Patient</h2>

<form action="add_patient.php" method="POST">

    First Name:<br>
    <input type="text" name="first_name" required><br><br>

    Last Name:<br>
    <input type="text" name="last_name" required><br><br>

    Date of Birth:<br>
    <input type="date" name="dob"><br><br>

    Gender:<br>
    <select name="gender">
        <option value="Male">Male</option>
        <option value="Female">Female</option>
        <option value="Other">Other</option>
    </select><br><br>

    Phone:<br>
    <input type="text" name="phone"><br><br>

    Email:<br>
    <input type="email" name="email"><br><br>

    Address:<br>
    <textarea name="address"></textarea><br><br>

    Blood Group:<br>
    <input type="text" name="blood_group"><br><br>

    <button type="submit">Register Patient</button>

</form>

</main>
<?php include __DIR__ . '/includes/footer.php'; ?>
</body>
</html>