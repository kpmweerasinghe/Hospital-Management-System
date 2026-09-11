<?php

function log_action($conn, $action, $table_name = null, $record_id = null)
{
    if (!isset($_SESSION['user_id'])) {
        return;
    }

    $user_id = $_SESSION['user_id'];
    $ip_address = $_SERVER['REMOTE_ADDR'];

    $sql = "INSERT INTO audit_logs
            (user_id, action, table_name, record_id, ip_address)
            VALUES (?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);

    $stmt->bind_param(
        "issis",
        $user_id,
        $action,
        $table_name,
        $record_id,
        $ip_address
    );

    $stmt->execute();
}

?>