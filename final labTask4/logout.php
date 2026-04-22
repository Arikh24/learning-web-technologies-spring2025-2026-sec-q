<?php
    require_once '../config.php';

    $_SESSION['admin_logged_in'] = false;
    unset($_SESSION['admin_id']);

    header("Location: login.html");
    exit();
?>
