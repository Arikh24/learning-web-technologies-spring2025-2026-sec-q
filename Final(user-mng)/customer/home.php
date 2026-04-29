<?php
require_once '../config.php';

if (!isset($_SESSION['customer_logged_in']) || $_SESSION['customer_logged_in'] !== true) {
    header("Location: login.html");
    exit();
}

$pdo      = getDB();
$products = $pdo->query("SELECT * FROM `product-list` ORDER BY id")->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Customer Home</title>
</head>
<body>

    <h2>Welcome, <?php echo htmlspecialchars($_SESSION['customer_name']); ?>!</h2>
    <hr>
    <a href="logout.php">Logout</a>
    <hr>

    <h3>Available Products</h3>

    <?php if (!empty($products)) { ?>

        <table border="1" cellpadding="8" cellspacing="0">
            <tr>
                <th>ID</th>
                <th>Product Name</th>
                <th>Price (BDT)</th>
            </tr>
            <?php foreach ($products as $product) { ?>
                <tr>
                    <td><?php echo $product['id']; ?></td>
                    <td><?php echo htmlspecialchars($product['name']); ?></td>
                    <td><?php echo number_format($product['price'], 2); ?></td>
                </tr>
            <?php } ?>
        </table>

    <?php } else { ?>
        <p>No products available at the moment.</p>
    <?php } ?>

</body>
</html>
