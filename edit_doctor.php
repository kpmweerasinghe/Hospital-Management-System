<?php

session_start();
include "session_check.php";
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

include "db.php";

$id = $_GET['id'];

$sql = "SELECT * FROM doctors WHERE doctor_id = $id";
$result = $conn->query($sql);
$doctor = $result->fetch_assoc();

$departments = $conn->query(
    "SELECT * FROM departments ORDER BY department_name"
);

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/jpeg" href="images/logo.jpeg">
    <link rel="stylesheet" href="css/style.css">
    <title>Viweka Hospital | Edit Doctor</title>
</head>

<body>
<?php include __DIR__ . '/includes/header.php'; ?>
<main class="page-wrapper">

<h1>Edit Doctor</h1>

<form action="update_doctor.php" method="POST">

<input type="hidden"
       name="doctor_id"
       value="<?php echo $doctor['doctor_id']; ?>">

Doctor Name:<br>
<input type="text"
       name="doctor_name"
       value="<?php echo $doctor['doctor_name']; ?>"
       required>
<br><br>

Specialization:<br>
<input type="text"
       name="specialization"
       value="<?php echo $doctor['specialization']; ?>"
       required>
<br><br>

Phone:<br>
<input type="text"
       name="phone"
       value="<?php echo $doctor['phone']; ?>">
<br><br>

Email:<br>
<input type="email"
       name="email"
       value="<?php echo $doctor['email']; ?>">
<br><br>

Department:<br>

<select name="department_id" required>

<?php while ($department = $departments->fetch_assoc()) { ?>

<option value="<?php echo $department['department_id']; ?>"
<?php
if ($department['department_id'] == $doctor['department_id']) {
    echo "selected";
}
?>>

<?php echo $department['department_name']; ?>

</option>

<?php } ?>

</select>

<br><br>

<button type="submit">Update Doctor</button>

</form>

<br>

<a href="view_doctors.php">Back to Doctors</a>

</main>
<?php include __DIR__ . '/includes/footer.php'; ?>
</body>

</html>