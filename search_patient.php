<?php

include "db.php";
include "role_check.php";

require_roles($conn, [
    'Administrator',
    'Doctor',
    'Nurse',
    'Receptionist'
]);

$search = $_GET['search'] ?? '';

$sql = "SELECT * FROM patients
        WHERE first_name LIKE '%$search%'
        OR last_name LIKE '%$search%'
        OR phone LIKE '%$search%'";

$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/jpeg" href="images/logo.jpeg">
    <link rel="stylesheet" href="css/style.css">
    <title>Viweka Hospital | Search Patient</title>
</head>

<body>
<?php include __DIR__ . '/includes/header.php'; ?>
<main class="page-wrapper">

<h1>Search Patient</h1>

<form method="GET">

    <input type="text"
           name="search"
           placeholder="Name or phone number"
           value="<?php echo $search; ?>">

    <button type="submit">Search</button>

</form>

<br>

<table border="1" cellpadding="10">

<tr>
    <th>ID</th>
    <th>Name</th>
    <th>Phone</th>
    <th>Gender</th>
    <th>Blood Group</th>
</tr>

<?php

while ($row = $result->fetch_assoc()) {

?>

<tr>

<td><?php echo $row['patient_id']; ?></td>

<td>
<?php
echo $row['first_name'] . " " . $row['last_name'];
?>
</td>

<td><?php echo $row['phone']; ?></td>

<td><?php echo $row['gender']; ?></td>

<td><?php echo $row['blood_group']; ?></td>

</tr>

<?php } ?>

</table>

</main>
<?php include __DIR__ . '/includes/footer.php'; ?>
</body>
</html>