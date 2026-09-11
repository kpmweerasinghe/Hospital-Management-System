<?php

include "db.php";
include "role_check.php";

require_roles($conn, [
    'Administrator',
    'Doctor',
    'Lab Staff'
]);

include_once "includes/response.php";

$test_id = $_POST['test_id'];
$result = $_POST['result'];

$result_date = date('Y-m-d');

$sql = "UPDATE laboratory_tests
        SET result = '$result',
            result_date = '$result_date',
            test_status = 'Result Ready'
        WHERE test_id = $test_id";

if ($conn->query($sql) === TRUE) {

    render_response('success', 'Laboratory Result Saved Successfully', '', [
        'view_lab_tests.php' => 'View Laboratory Tests',
    ]);

} else {

    render_response('error', 'Something Went Wrong', 'Error: ' . $conn->error, [
        'view_lab_tests.php' => 'Back',
    ]);

}

?>