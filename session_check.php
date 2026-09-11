<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$timeout = 15 * 60; // 15 minutes

if (isset($_SESSION['last_activity'])) {

    if (time() - $_SESSION['last_activity'] > $timeout) {

        session_unset();
        session_destroy();

        header("Location: login.php?timeout=1");
        exit();
    }
}

$_SESSION['last_activity'] = time();

?>