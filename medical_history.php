<?php

session_start();
include "session_check.php";
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

include "db.php";

$patient_id = $_GET['patient_id'];

$sql = "SELECT * FROM patients WHERE patient_id = $patient_id";
$patient_result = $conn->query($sql);
$patient = $patient_result->fetch_assoc();

$sql = "SELECT * FROM medical_records
        WHERE patient_id = $patient_id
        ORDER BY visit_date DESC";

$records = $conn->query($sql);

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/jpeg" href="images/logo.jpeg">
    <link rel="stylesheet" href="css/style.css">
    <title>Viweka Hospital | Medical History</title>
</head>

<body>
<?php include __DIR__ . '/includes/header.php'; ?>
<main class="page-wrapper">

<h1>Medical History</h1>

<h2>
Patient:
<?php
echo $patient['first_name'] . " " . $patient['last_name'];
?>
</h2>

<p>
Patient ID:
<?php echo $patient['patient_id']; ?>
</p>

<hr>

<h2>Medical Records</h2>

<?php

if ($records->num_rows > 0) {

    while ($record = $records->fetch_assoc()) {

?>

<div>

<p>
<strong>Visit Date:</strong>
<?php echo $record['visit_date']; ?>
</p>

<p>
<strong>Diagnosis:</strong>
<?php echo $record['diagnosis']; ?>
</p>

<p>
<strong>Treatment:</strong>
<?php echo $record['treatment']; ?>
</p>

<p>
<strong>Prescription:</strong>
<?php echo $record['prescription']; ?>
</p>

<hr>

</div>

<?php

    }

} else {

    echo "No medical records found.";

}

?>

<a href="view_patients.php">Back to Patients</a>

<h2>Patient Documents</h2>

<a href="upload_document.php">
    Upload New Document
</a>

<br><br>

<a href="view_documents.php">
    View Patient Documents
</a>

</main>
<?php include __DIR__ . '/includes/footer.php'; ?>
</body>

</html>