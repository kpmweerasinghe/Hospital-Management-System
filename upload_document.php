<?php

session_start();

include "session_check.php";
include "db.php";
include "role_check.php";

require_roles($conn, [
    'Administrator',
    'Doctor',
    'Nurse',
    'Receptionist'
]);

// Get patients
$sql = "SELECT patient_id, first_name, last_name
        FROM patients
        ORDER BY first_name, last_name";

$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/jpeg" href="images/logo.jpeg">
    <link rel="stylesheet" href="css/style.css">

    <title>Viweka Hospital | Upload Patient Document</title>

</head>

<body>
<?php include __DIR__ . '/includes/header.php'; ?>
<main class="page-wrapper">

<h1>Upload Patient Document</h1>

<a href="dashboard.php">Back to Dashboard</a>

<br><br>

<form action="save_document.php"
      method="POST"
      enctype="multipart/form-data">

    <label>Select Patient:</label>

    <br>

    <select name="patient_id" required>

        <option value="">-- Select Patient --</option>

        <?php while ($patient = $result->fetch_assoc()) { ?>

            <option value="<?php echo $patient['patient_id']; ?>">

                <?php
                echo htmlspecialchars(
                    $patient['first_name'] . " " . $patient['last_name']
                );
                ?>

            </option>

        <?php } ?>

    </select>

    <br><br>

    <label>Select Document:</label>

    <br>

    <input
        type="file"
        name="document"
        accept=".pdf,.jpg,.jpeg,.png,.doc,.docx"
        required
    >

    <br><br>

    <button type="submit">
        Upload Document
    </button>

</form>

<br>

<a href="view_documents.php">
    View Patient Documents
</a>

</main>
<?php include __DIR__ . '/includes/footer.php'; ?>
</body>

</html>