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

$sql = "SELECT
            patient_documents.document_id,
            patient_documents.document_name,
            patient_documents.file_path,
            patient_documents.uploaded_at,
            patients.first_name,
            patients.last_name

        FROM patient_documents

        INNER JOIN patients
        ON patient_documents.patient_id = patients.patient_id

        ORDER BY patient_documents.document_id DESC";

$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/jpeg" href="images/logo.jpeg">
    <link rel="stylesheet" href="css/style.css">

    <title>Viweka Hospital | Patient Documents</title>

</head>

<body>
<?php include __DIR__ . '/includes/header.php'; ?>
<main class="page-wrapper">

<h1>Patient Documents</h1>

<a href="dashboard.php">
    Back to Dashboard
</a>

<br><br>

<a href="upload_document.php">
    + Upload New Document
</a>

<br><br>

<?php if ($result->num_rows > 0) { ?>

<table border="1" cellpadding="10" cellspacing="0">

<tr>

    <th>ID</th>
    <th>Patient</th>
    <th>Document</th>
    <th>Uploaded Date</th>
    <th>Action</th>

</tr>

<?php while ($row = $result->fetch_assoc()) { ?>

<tr>

    <td>
        <?php echo $row['document_id']; ?>
    </td>

    <td>

        <?php

        echo htmlspecialchars(
            $row['first_name'] .
            " " .
            $row['last_name']
        );

        ?>

    </td>

    <td>

        <?php

        echo htmlspecialchars(
            $row['document_name']
        );

        ?>

    </td>

    <td>
        <?php echo $row['uploaded_at']; ?>
    </td>

    <td>

        <a
            href="<?php echo htmlspecialchars($row['file_path']); ?>"
            target="_blank"
        >
            View Document
        </a>

    </td>

</tr>

<?php } ?>

</table>

<?php } else { ?>

    <p>No patient documents found.</p>

<?php } ?>

<br>

<a href="dashboard.php">
    Back to Dashboard
</a>

</main>
<?php include __DIR__ . '/includes/footer.php'; ?>
</body>

</html>