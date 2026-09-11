<?php

include "db.php";
include_once "includes/response.php";

$id = $_GET['id'];

$sql = "DELETE FROM medicines
        WHERE medicine_id = $id";

if ($conn->query($sql) === TRUE) {

    header("Location: view_medicines.php");
    exit();

} else {

    render_response('error', 'Something Went Wrong', 'Error: ' . $conn->error, [
        'view_medicines.php' => 'Back',
    ]);

}

?>