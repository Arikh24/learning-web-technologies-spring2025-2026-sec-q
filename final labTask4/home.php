<?php
    require_once '../config.php';

    if(!isset($_SESSION['customer_logged_in']) || $_SESSION['customer_logged_in'] != true){
        header("Location: login.html");
        exit();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Customer Home</title>
</head>
<body>

    <h2>Welcome, <?php echo $_SESSION['customer_name']; ?>!</h2>
    <hr>
    <a href="logout.php">Logout</a>
    <hr>

    <h3>Available Products</h3>

    <?php if(!empty($_SESSION['products'])){ ?>

        <table border="1" cellpadding="8" cellspacing="0">
            <tr>
                <th>ID</th>
                <th>Product Name</th>
                <th>Price (BDT)</th>
            </tr>

            <?php foreach($_SESSION['products'] as $product){ ?>
                <tr>
                    <td><?php echo $product['id']; ?></td>
                    <td><?php echo $product['name']; ?></td>
                    <td><?php echo $product['price']; ?></td>
                </tr>
            <?php } ?>

        </table>

    <?php } else { ?>

        <p>Empty Product !</p>

    <?php } ?>

</body>
</html>
