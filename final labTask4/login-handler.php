<?php
    require_once '../config.php';

    if(isset($_POST['submit'])){

        $entered_email    = $_POST['email'];
        $entered_password = $_POST['password'];

        $login_success = false;

        foreach($_SESSION['customers'] as $customer){
            if($customer['email'] == $entered_email && $customer['password'] == $entered_password){
                $login_success         = true;
                $logged_in_customer    = $customer;
                break;
            }
        }

        if($login_success){

            $_SESSION['customer_logged_in'] = true;
            $_SESSION['customer_name']      = $logged_in_customer['name'];
            $_SESSION['customer_email']     = $logged_in_customer['email'];

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
