<?php

include "db.php";
include "role_check.php";

require_roles($conn, [
    'Administrator',
    'Doctor',
    'Lab Staff'
]);

include_once "includes/response.php";

$id = $_GET['id'];

$sql = "UPDATE laboratory_tests
        SET sample_status = 'Collected',
            test_status = 'Sample Collected'
        WHERE test_id = $id";

if ($conn->query($sql) === TRUE) {

    header("Location: view_lab_tests.php");
    exit();

} else {

    render_response('error', 'Something Went Wrong', 'Error: ' . $conn->error, [
        'view_lab_tests.php' => 'Back',
    ]);

}

?>