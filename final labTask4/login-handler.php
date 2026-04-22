<?php
    require_once '../config.php';

    if(isset($_POST['submit'])){

        $entered_id       = $_POST['admin_id'];
        $entered_password = $_POST['password'];

        if($entered_id == $admin_id && $entered_password == $admin_password){

            $_SESSION['admin_logged_in'] = true;
            $_SESSION['admin_id']        = $entered_id;
            header("Location: home.php");
            exit();

        } else {

            echo "<p>Invalid Admin ID or Password. <a href='login.html'>Try Again</a></p>";

        }

    } else {

        header("Location: login.html");
        exit();

    }
?>
