<?php
    require_once '../config.php';

    if(!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] != true){
        header("Location: login.html");
        exit();
    }

    if(isset($_POST['submit'])){

        $name  = $_POST['name'];
        $price = $_POST['price'];

        if($name != "" && $price != ""){

            $new_product = [
                "id"    => $_SESSION['next_id'],
                "name"  => $name,
                "price" => $price
            ];

            $_SESSION['products'][] = $new_product;
            $_SESSION['next_id']++;

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
