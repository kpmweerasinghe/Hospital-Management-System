<?php

include "db.php";
include_once "includes/response.php";

$username = $_POST['username'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
$role_id = $_POST['role_id'];
$status = $_POST['status'];

$sql = "INSERT INTO users
        (username, password, role_id, status)
        VALUES
        ('$username',
         '$password',
         '$role_id',
         '$status')";

if ($conn->query($sql) === TRUE) {

    render_response('success', 'User Created Successfully', '', [
        'users.php' => 'Create Another User',
        'view_users.php' => 'View Users',
    ]);

} else {

    render_response('error', 'Something Went Wrong', 'Error: ' . $conn->error, [
        'users.php' => 'Back',
    ]);

}

?>