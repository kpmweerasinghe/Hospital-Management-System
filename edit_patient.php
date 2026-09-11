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

$id = $_GET['id'];

$sql = "SELECT * FROM patients WHERE patient_id = $id";
$result = $conn->query($sql);

$patient = $result->fetch_assoc();

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/jpeg" href="images/logo.jpeg">
    <link rel="stylesheet" href="css/style.css">
    <title>Viweka Hospital | Edit Patient</title>
</head>

<body>
<?php include __DIR__ . '/includes/header.php'; ?>
<main class="page-wrapper">

<h1>Edit Patient</h1>

<form action="update_patient.php" method="POST">

    <input type="hidden"
           name="patient_id"
           value="<?php echo $patient['patient_id']; ?>">

    First Name:<br>
    <input type="text"
           name="first_name"
           value="<?php echo $patient['first_name']; ?>"
           required>
    <br><br>

    Last Name:<br>
    <input type="text"
           name="last_name"
           value="<?php echo $patient['last_name']; ?>"
           required>
    <br><br>

    Date of Birth:<br>
    <input type="date"
           name="dob"
           value="<?php echo $patient['dob']; ?>">
    <br><br>

    Gender:<br>
    <select name="gender">

        <option value="Male"
        <?php if($patient['gender']=="Male") echo "selected"; ?>>
        Male
        </option>

        <option value="Female"
        <?php if($patient['gender']=="Female") echo "selected"; ?>>
        Female
        </option>

        <option value="Other"
        <?php if($patient['gender']=="Other") echo "selected"; ?>>
        Other
        </option>

    </select>
    <br><br>

    Phone:<br>
    <input type="text"
           name="phone"
           value="<?php echo $patient['phone']; ?>">
    <br><br>

    Email:<br>
    <input type="email"
           name="email"
           value="<?php echo $patient['email']; ?>">
    <br><br>

    Address:<br>
    <textarea name="address"><?php echo $patient['address']; ?></textarea>
    <br><br>

    Blood Group:<br>
    <input type="text"
           name="blood_group"
           value="<?php echo $patient['blood_group']; ?>">
    <br><br>

    <button type="submit">Update Patient</button>

</form>

<br>

<a href="view_patients.php">Back to Patient List</a>

</main>
<?php include __DIR__ . '/includes/footer.php'; ?>
</body>
</html>