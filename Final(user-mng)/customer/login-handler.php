<?php
require_once '../config.php';

if (isset($_POST['submit'])) {

    $entered_email    = trim($_POST['email']);
    $entered_password = $_POST['password'];

    $pdo  = getDB();
    $stmt = $pdo->prepare("SELECT * FROM `user-list` WHERE email = ?");
    $stmt->execute([$entered_email]);
    $customer = $stmt->fetch();
    if ($customer && !empty($customer['password']) && password_verify($entered_password, $customer['password'])) {
        $_SESSION['customer_logged_in'] = true;
        $_SESSION['customer_name']      = $customer['name'];
        $_SESSION['customer_email']     = $customer['email'];
        header("Location: home.php");
        exit();
    } else {
        echo "<p>Invalid email or password. <a href='login.html'>Try Again</a></p>";
    }

} else {
    header("Location: login.html");
    exit();
}
?>
