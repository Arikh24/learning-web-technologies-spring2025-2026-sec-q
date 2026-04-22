<?php
    require_once '../config.php';

    if(!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] != true){
        header("Location: login.html");
        exit();
    }

    if(isset($_GET['id'])){

        $delete_id       = $_GET['id'];
        $updated_products = [];

        foreach($_SESSION['products'] as $product){
            if($product['id'] != $delete_id){
                $updated_products[] = $product;
            }
        }

        $_SESSION['products'] = $updated_products;

        header("Location: home.php");
        exit();

    } else {

        header("Location: home.php");
        exit();

    }
?>
