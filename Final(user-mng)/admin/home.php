<?php
require_once '../config.php';

if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: login.html");
    exit();
}

$pdo      = getDB();
$products = $pdo->query("SELECT * FROM `product-list` ORDER BY id")->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Admin-Home</title>
</head>
<body>

    <h2>Welcome</h2>
    <hr>
    <a href="insert.html">Add New Product</a>
    &nbsp;&nbsp;
    <a href="logout.php">Logout</a>
    <hr>

    <h3>List of Products</h3>

    <?php if (!empty($products)) { ?>

        <table border="1" cellpadding="8" cellspacing="0">
            <tr>
                <th>ID</th>
                <th>Product</th>
                <th>Price (BDT)</th>
                <th>Actions</th>
            </tr>
            <?php foreach ($products as $product) { ?>
                <tr>
                    <td><?php echo $product['id']; ?></td>
                    <td><?php echo htmlspecialchars($product['name']); ?></td>
                    <td><?php echo number_format($product['price'], 2); ?></td>
                    <td>
                        <a href="update.php?id=<?php echo $product['id']; ?>">Update</a>
                        &nbsp;
                        <a href="delete-handler.php?id=<?php echo $product['id']; ?>"
                           onclick="return confirm('Delete this product?')">Delete</a>
                    </td>
                </tr>
            <?php } ?>
        </table>

    <?php } else { ?>
        <p>No products available. Please insert a product.</p>
    <?php } ?>

</body>
</html>
