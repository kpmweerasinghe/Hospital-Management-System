<?php

include "db.php";
include_once "includes/response.php";

$id = $_GET['id'];

$sql = "DELETE FROM doctors WHERE doctor_id = $id";

if ($conn->query($sql) === TRUE) {

    header("Location: view_doctors.php");
    exit();

} else {

    render_response('error', 'Something Went Wrong', 'Error: ' . $conn->error, [
        'view_doctors.php' => 'Back',
    ]);

}

?>