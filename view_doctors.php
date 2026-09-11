<?php

session_start();
include "session_check.php";
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

include "db.php";

$sql = "SELECT doctors.*, departments.department_name
        FROM doctors
        LEFT JOIN departments
        ON doctors.department_id = departments.department_id
        ORDER BY doctors.doctor_id DESC";

$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/jpeg" href="images/logo.jpeg">
    <link rel="stylesheet" href="css/style.css">
    <title>Viweka Hospital | Doctors</title>
</head>

<body>
<?php include __DIR__ . '/includes/header.php'; ?>
<main class="page-wrapper">

<h1>Doctor List</h1>

<a href="doctors.php">+ Register Doctor</a>

<br><br>

<table border="1" cellpadding="10">

<tr>
    <th>ID</th>
    <th>Doctor Name</th>
    <th>Specialization</th>
    <th>Phone</th>
    <th>Email</th>
    <th>Department</th>
    <th>Action</th>
</tr>

<?php while ($row = $result->fetch_assoc()) { ?>

<tr>

    <td><?php echo $row['doctor_id']; ?></td>

    <td><?php echo $row['doctor_name']; ?></td>

    <td><?php echo $row['specialization']; ?></td>

    <td><?php echo $row['phone']; ?></td>

    <td><?php echo $row['email']; ?></td>

    <td><?php echo $row['department_name']; ?></td>
    <td>
    <a href="edit_doctor.php?id=<?php echo $row['doctor_id']; ?>">
        Edit
    </a>

|

<a href="delete_doctor.php?id=<?php echo $row['doctor_id']; ?>"
   onclick="return confirm('Are you sure you want to delete this doctor?');">
    Delete
</a>
</td>

</tr>

<?php } ?>

</table>

</main>
<?php include __DIR__ . '/includes/footer.php'; ?>
</body>

</html>