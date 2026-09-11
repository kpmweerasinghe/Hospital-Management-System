<?php

session_start();
include "session_check.php";
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

include "db.php";

$sql = "SELECT * FROM patients
        ORDER BY patient_id DESC";

$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/jpeg" href="images/logo.jpeg">
    <link rel="stylesheet" href="css/style.css">

    <title>Viweka Hospital | Patient Report</title>

</head>

<body>
<?php include __DIR__ . '/includes/header.php'; ?>
<main class="page-wrapper">

<h1>Patient Report</h1>

<table border="1" cellpadding="10">

<tr>

    <th>ID</th>
    <th>First Name</th>
    <th>Last Name</th>
    <th>Date of Birth</th>
    <th>Gender</th>
    <th>Phone</th>
    <th>Email</th>
    <th>Blood Group</th>

</tr>

<?php while ($row = $result->fetch_assoc()) { ?>

<tr>

    <td><?php echo $row['patient_id']; ?></td>
    <td><?php echo $row['first_name']; ?></td>
    <td><?php echo $row['last_name']; ?></td>
    <td><?php echo $row['dob']; ?></td>
    <td><?php echo $row['gender']; ?></td>
    <td><?php echo $row['phone']; ?></td>
    <td><?php echo $row['email']; ?></td>
    <td><?php echo $row['blood_group']; ?></td>

</tr>

<?php } ?>

</table>

<br>

<button onclick="window.print()">
    Print Report
</button>

<br><br>

<a href="reports.php">
    Back to Reports
</a>

</main>
<?php include __DIR__ . '/includes/footer.php'; ?>
</body>

</html>