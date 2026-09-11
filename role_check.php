<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

function require_roles($conn, $allowed_roles)
{
    include_once __DIR__ . "/includes/response.php";

    $user_id = $_SESSION['user_id'];

    $sql = "SELECT roles.role_name
            FROM users
            INNER JOIN roles
            ON users.role_id = roles.role_id
            WHERE users.user_id = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();

    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if (!$user || !in_array($user['role_name'], $allowed_roles)) {

        http_response_code(403);

        render_response('error', 'Access Denied', 'You do not have permission to access this page.', [
            'dashboard.php' => 'Back to Dashboard',
        ]);
        exit();
    }
}

?>