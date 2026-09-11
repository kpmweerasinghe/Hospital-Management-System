<?php

session_start();
include "session_check.php";
session_unset();

session_destroy();

header("Location: login.php");

exit();

?>