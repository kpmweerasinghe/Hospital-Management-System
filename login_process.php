<?php

session_start();
include "session_check.php";
include "db.php";
include_once "includes/response.php";

$username = $_POST['username'];
$password = $_POST['password'];

$sql = "SELECT *
        FROM users
        WHERE username = ?
        AND status = 'Active'";

$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $username);
$stmt->execute();

$result = $stmt->get_result();

if ($result->num_rows == 1) {

    $user = $result->fetch_assoc();

    if (password_verify($password, $user['password'])) {

        session_regenerate_id(true);

        $_SESSION['user_id'] = $user['user_id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['role_id'] = $user['role_id'];
        $_SESSION['last_activity'] = time();

        header("Location: dashboard.php");
        exit();


    } else {

        render_response('error', 'Login Failed', 'Invalid username or password.', [
            'login.php' => 'Try Again',
        ]);

    }

} else {

    render_response('error', 'Login Failed', 'Invalid username or password.', [
        'login.php' => 'Try Again',
    ]);

}

?>