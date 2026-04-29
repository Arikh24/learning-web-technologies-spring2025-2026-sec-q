<?php
require_once '../config.php';

if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: login.html");
    exit();
}

if (isset($_POST['submit'])) {

    $id        = $_POST['id'];
    $new_name  = trim($_POST['name']);
    $new_price = trim($_POST['price']);

    if ($new_name !== '' && $new_price !== '') {

        $pdo  = getDB();
        $stmt = $pdo->prepare(
            "UPDATE `product-list` SET name = ?, price = ? WHERE id = ?"
        );
        $stmt->execute([$new_name, $new_price, $id]);

        header("Location: home.php");
        exit();

    } else {
        echo "<p>All fields are required. <a href='update.php?id="
            . htmlspecialchars($id) . "'>Go Back</a></p>";
    }

} else {
    header("Location: home.php");
    exit();
}
?>
