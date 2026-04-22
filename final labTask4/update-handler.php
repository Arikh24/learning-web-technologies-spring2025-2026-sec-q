<?php
    require_once '../config.php';

    if(!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] != true){
        header("Location: login.html");
        exit();
    }

    if(isset($_POST['submit'])){

        $update_id = $_POST['id'];
        $new_name  = $_POST['name'];
        $new_price = $_POST['price'];

        if($new_name != "" && $new_price != ""){

            foreach($_SESSION['products'] as $key => $product){
                if($product['id'] == $update_id){
                    $_SESSION['products'][$key]['name']  = $new_name;
                    $_SESSION['products'][$key]['price'] = $new_price;
                    break;
                }
            }

            header("Location: home.php");
            exit();

        } else {

            echo "<p>All fields are required. <a href='update.php?id=" . $update_id . "'>Go Back</a></p>";

        }

    } else {

        header("Location: home.php");
        exit();

    }
?>
