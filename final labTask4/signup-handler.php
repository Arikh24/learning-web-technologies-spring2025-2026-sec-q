<?php
    require_once '../config.php';

    if(isset($_POST['submit'])){

        $name     = $_POST['name'];
        $email    = $_POST['email'];
        $password = $_POST['password'];

        if($name != "" && $email != "" && $password != ""){

            $email_exists = false;

            foreach($_SESSION['customers'] as $customer){
                if($customer['email'] == $email){
                    $email_exists = true;
                    break;
                }
            }

            if($email_exists){

                echo "<p>This email is already registered. <a href='login.html'>Login Here</a></p>";

            } else {

                $new_customer = [
                    "name"     => $name,
                    "email"    => $email,
                    "password" => $password
                ];

                $_SESSION['customers'][] = $new_customer;

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
