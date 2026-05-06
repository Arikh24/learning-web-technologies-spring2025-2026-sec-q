<?php
session_start();
if (isset($_SESSION['admin_id'])) {
    header('Location: dashboard.php');
    exit;
}

$error = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require 'includes/db.php';
    $username = $_POST['username'];
    $password = $_POST['password'];

    if (!$username || !$password) {
        $error = "Please fill all fields.";
    } else {
        $stmt = $pdo->prepare("SELECT * FROM admins WHERE username = ?");
        $stmt->execute([$username]);
        $admin = $stmt->fetch();

        if ($admin && password_verify($password, $admin['password'])) {
            $_SESSION['admin_id'] = $admin['id'];
            $_SESSION['admin_username'] = $admin['username'];
            header('Location: dashboard.php');
            exit;
        } else {
            $error = "Wrong username or password.";
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>
    <h2>Admin Login</h2>

    <?php if ($error): ?>
        <p style="color:red;"><?= $error ?></p>
    <?php endif; ?>

    <form method="POST" onsubmit="return validate()">
        <p>
            Username: <input type="text" name="username" id="username">
        </p>
        <p>
            Password: <input type="password" name="password" id="password">
        </p>
        <p>
            <input type="submit" value="Login">
        </p>
    </form>

    <p>No account? <a href="register.php">Register here</a></p>

    <script>
    function validate() {
        var username = document.getElementById('username').value;
        var password = document.getElementById('password').value;
        if (username == '' || password == '') {
            alert('Please fill all fields!');
            return false;
        }
        return true;
    }
    </script>
</body>
</html>
