<?php
require_once '../config.php';

if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: login.html");
    exit();
}

if (isset($_POST['submit'])) {

    $name  = trim($_POST['name']);
    $price = trim($_POST['price']);

    if ($name !== '' && $price !== '') {

        $pdo  = getDB();
        $stmt = $pdo->prepare("INSERT INTO `product-list` (name, price) VALUES (?, ?)");
        $stmt->execute([$name, $price]);

        header("Location: home.php");
        exit();

    } else {
        echo "<p>All fields are required. <a href='insert.html'>Go Back</a></p>";
    }

} else {
    header("Location: insert.html");
    exit();
}
?>
