<?php
    require_once '../config.php';

    if(!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] != true){
        header("Location: login.html");
        exit();
    }

    if(isset($_GET['id'])){

        $update_id = $_GET['id'];
        $found     = false;

        foreach($_SESSION['products'] as $product){
            if($product['id'] == $update_id){
                $found        = true;
                $product_name  = $product['name'];
                $product_price = $product['price'];
                break;
            }
        }

        if(!$found){
            echo "<p>Product not found. <a href='home.php'>Go Back</a></p>";
            exit();
        }

    } else {

        header("Location: home.php");
        exit();

    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Update Product</title>
</head>
<body>

    <h2>Update Product</h2>
    <hr>
    <form action="update-handler.php" method="post">
        <fieldset>
            <legend><b>UPDATE PRODUCT</b></legend>
            <input type="hidden" name="id" value="<?php echo $update_id; ?>">
            <label>Product Name:</label><br>
            <input type="text" name="name" value="<?php echo $product_name; ?>"><br><br>
            <label>Price (BDT):</label><br>
            <input type="text" name="price" value="<?php echo $product_price; ?>"><br><br>
            <hr>
            <input type="submit" name="submit" value="Update">
        </fieldset>
    </form>
    <br>
    <a href="home.php">Back to Product List</a>

</body>
</html>
