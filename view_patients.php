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

$sql = "SELECT * FROM patients ORDER BY patient_id DESC";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/jpeg" href="images/logo.jpeg">
    <link rel="stylesheet" href="css/style.css">
    <title>Viweka Hospital | View Patients</title>
</head>

<body>
<?php include __DIR__ . '/includes/header.php'; ?>
<main class="page-wrapper">

<h1>Patient List</h1>

<a href="patients.php">+ Register New Patient</a>

<br><br>

<table border="1" cellpadding="10">

<tr>
    <th>ID</th>
    <th>First Name</th>
    <th>Last Name</th>
    <th>DOB</th>
    <th>Gender</th>
    <th>Phone</th>
    <th>Email</th>
    <th>Blood Group</th>
    <th>Action</th>
</tr>

<?php

while ($row = $result->fetch_assoc()) {

?>

<tr>

    <td><?php echo $row['patient_id']; ?></td>
    <td><?php echo $row['first_name']; ?></td>
    <td><?php echo $row['last_name']; ?></td>
    <td><?php echo $row['dob']; ?></td>
    <td><?php echo $row['gender']; ?></td>
    <td><?php echo $row['phone']; ?></td>
    <td><?php echo $row['email']; ?></td>
    <td><?php echo $row['blood_group']; ?></td>

    <td>

<a href="edit_patient.php?id=<?php echo $row['patient_id']; ?>">
    Edit
</a>

|

<a href="delete_patient.php?id=<?php echo $row['patient_id']; ?>"
   onclick="return confirm('Are you sure you want to delete this patient?');">
    Delete
</a>

|

<a href="medical_history.php?patient_id=<?php echo $row['patient_id']; ?>">
    Medical History
</a>

</td>

</tr>

<?php

}

?>

</table>

</main>
<?php include __DIR__ . '/includes/footer.php'; ?>
</body>
</html>