<?php
require_once '../config.php';

if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: login.html");
    exit();
}

if (isset($_GET['id'])) {

    $pdo  = getDB();
    $stmt = $pdo->prepare("DELETE FROM `product-list` WHERE id = ?");
    $stmt->execute([$_GET['id']]);

    header("Location: home.php");
    exit();

} else {
    header("Location: home.php");
    exit();
}
?>
