<?php

session_start();
include "session_check.php";
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

include "db.php";

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
    <title>Viweka Hospital | Doctor Management</title>
</head>

<body>
<?php include __DIR__ . '/includes/header.php'; ?>
<main class="page-wrapper">

<h1>Doctor Management</h1>

<h2>Register Doctor</h2>

<form action="add_doctor.php" method="POST">

    Doctor Name:<br>
    <input type="text" name="doctor_name" required>
    <br><br>

    Specialization:<br>
    <input type="text" name="specialization" required>
    <br><br>

    Phone:<br>
    <input type="text" name="phone">
    <br><br>

    Email:<br>
    <input type="email" name="email">
    <br><br>

    Department:<br>

    <select name="department_id" required>

        <option value="">Select Department</option>

        <?php while ($department = $departments->fetch_assoc()) { ?>

            <option value="<?php echo $department['department_id']; ?>">
                <?php echo $department['department_name']; ?>
            </option>

        <?php } ?>

    </select>

    <br><br>

    <button type="submit">Register Doctor</button>

</form>

<br>

<a href="view_doctors.php">View Doctors</a>

</main>
<?php include __DIR__ . '/includes/footer.php'; ?>
</body>

</html>