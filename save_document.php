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

include_once "includes/response.php";

// Check whether file was uploaded
if (!isset($_FILES['document']) || $_FILES['document']['error'] !== UPLOAD_ERR_OK) {

    render_response('error', 'Upload Failed', 'Please select a valid document.', [
        'upload_document.php' => 'Back',
    ]);
    exit();
}

$patient_id = $_POST['patient_id'];

$file = $_FILES['document'];

$original_name = $file['name'];
$tmp_name = $file['tmp_name'];
$file_size = $file['size'];

// Allowed file types
$allowed_extensions = [
    'pdf',
    'jpg',
    'jpeg',
    'png',
    'doc',
    'docx'
];

// Get file extension
$extension = strtolower(
    pathinfo($original_name, PATHINFO_EXTENSION)
);

// Check extension
if (!in_array($extension, $allowed_extensions)) {

    render_response('error', 'Invalid File Type', 'Allowed files: PDF, JPG, JPEG, PNG, DOC and DOCX.', [
        'upload_document.php' => 'Back',
    ]);
    exit();
}

// Maximum file size = 5 MB
$max_size = 5 * 1024 * 1024;

if ($file_size > $max_size) {

    render_response('error', 'File Too Large', 'Maximum file size is 5 MB.', [
        'upload_document.php' => 'Back',
    ]);
    exit();
}

// Check that patient exists
$sql = "SELECT patient_id
        FROM patients
        WHERE patient_id = ?";

$stmt = $conn->prepare($sql);

$stmt->bind_param(
    "i",
    $patient_id
);

$stmt->execute();

$result = $stmt->get_result();

if ($result->num_rows == 0) {

    render_response('error', 'Invalid Patient', 'The selected patient does not exist.', [
        'upload_document.php' => 'Back',
    ]);
    exit();
}

// Create unique filename
$new_filename =
    "patient_" .
    $patient_id .
    "_" .
    time() .
    "_" .
    uniqid() .
    "." .
    $extension;

// Upload location
$upload_folder = "uploads/";

$file_path = $upload_folder . $new_filename;

// Move file
if (move_uploaded_file($tmp_name, $file_path)) {

    // Save information in database
    $sql = "INSERT INTO patient_documents
            (patient_id, document_name, file_path)
            VALUES (?, ?, ?)";

    $stmt = $conn->prepare($sql);

    $stmt->bind_param(
        "iss",
        $patient_id,
        $original_name,
        $file_path
    );

    if ($stmt->execute()) {

        render_response(
            'success',
            'Document Uploaded Successfully',
            'File: ' . htmlspecialchars($original_name),
            [
                'upload_document.php' => 'Upload Another Document',
                'view_documents.php' => 'View Documents',
                'dashboard.php' => 'Back to Dashboard',
            ]
        );

    } else {

        // Delete uploaded file if database insertion fails
        if (file_exists($file_path)) {
            unlink($file_path);
        }

        render_response('error', 'Database Error', $conn->error, [
            'upload_document.php' => 'Back',
        ]);
    }

} else {

    render_response('error', 'File Upload Failed', '', [
        'upload_document.php' => 'Try Again',
    ]);

}

?>