<?php
require_once '../config.php';

if (isset($_POST['submit'])) {

    $name     = trim($_POST['name']);
    $email    = trim($_POST['email']);
    $password = $_POST['password'];

    if ($name !== '' && $email !== '' && $password !== '') {

        $pdo = getDB();
        $stmt = $pdo->prepare("SELECT id FROM `user-list` WHERE email = ?");
        $stmt->execute([$email]);

        if ($stmt->fetch()) {

            echo "<p>This email is already registered. <a href='login.html'>Login Here</a></p>";

        } else {

            $hashed = password_hash($password, PASSWORD_DEFAULT);

            $insert = $pdo->prepare(
                "INSERT INTO `user-list` (name, email, password) VALUES (?, ?, ?)"
            );
            $insert->execute([$name, $email, $hashed]);

            echo "<p>Signup successful! <a href='login.html'>Login Here</a></p>";
        }

    } else {
        echo "<p>All fields are required. <a href='signup.html'>Go Back</a></p>";
    }

} else {
    header("Location: signup.html");
    exit();
}
?>
