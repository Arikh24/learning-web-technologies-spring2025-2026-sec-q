<?php
session_start();
if(isset($_POST['submit']))
    {
        $username =$_POST['username'];
        $password =$_POST['password'];
        if($username == "" || $password == "")
            {
                echo "Fillup The Fields";
            }
             elseif(!isset($_SESSION['users'][$username.'_password'])) {
        echo "User not found. Please register first.";
    }
    elseif($_SESSION['users'][$username.'_password'] !== $password) {
        echo "Invalid password!";
    }
    else {
        $_SESSION['loggedin'] = $username;
        echo "Login successful! Welcome, ".$username;
        echo "<br><a href='home.html'>Go to home paze</a>";
    }

?>
<form method="post">
    Username :<input type ="text" name="username"><br>
    Password :<input type ="password" name="password"><br>
    <input type="submit" name="submit" value="Login"><br>
    <a href="forgot.php">Forgot Password?</a>
</form>