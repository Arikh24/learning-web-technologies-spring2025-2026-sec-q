<?php
session_start();
if (isset($_SESSION['admin_id'])) {
    header('Location: dashboard.php');
    exit;
}

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require 'includes/db.php';
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirm  = $_POST['confirm_password'];

    if (!$username || !$password || !$confirm) {
        $error = "Please fill all fields.";
    } elseif ($password != $confirm) {
        $error = "Passwords do not match.";
    } else {
        $check = $pdo->prepare("SELECT id FROM admins WHERE username = ?");
        $check->execute([$username]);
        if ($check->fetch()) {
            $error = "Username already taken.";
        } else {
            $hashed = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $pdo->prepare("INSERT INTO admins (username, password) VALUES (?, ?)");
            $stmt->execute([$username, $hashed]);
            $success = "Account created! You can now login.";
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
</head>
<body>
    <h2>Admin Registration</h2>

    <?php if ($error): ?>
        <p style="color:red;"><?= $error ?></p>
    <?php endif; ?>
    <?php if ($success): ?>
        <p style="color:green;"><?= $success ?> <a href="index.php">Login</a></p>
    <?php endif; ?>

    <form method="POST" onsubmit="return validate()">
        <p>
            Username: <input type="text" name="username" id="username">
        </p>
        <p>
            Password: <input type="password" name="password" id="password">
        </p>
        <p>
            Confirm Password: <input type="password" name="confirm_password" id="confirm_password">
        </p>
        <p>
            <input type="submit" value="Register">
        </p>
    </form>

    <p>Already have account? <a href="index.php">Login here</a></p>

    <script>
    function validate() {
        var username = document.getElementById('username').value;
        var password = document.getElementById('password').value;
        var confirm  = document.getElementById('confirm_password').value;

        if (username == '' || password == '' || confirm == '') {
            alert('Please fill all fields!');
            return false;
        }
        if (password != confirm) {
            alert('Passwords do not match!');
            return false;
        }
        return true;
    }
    </script>
</body>
</html>
