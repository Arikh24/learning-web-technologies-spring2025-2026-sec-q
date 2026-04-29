<?php
require_once '../config.php';

if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: login.html");
    exit();
}

if (isset($_GET['id'])) {

    $pdo  = getDB();
    $stmt = $pdo->prepare("SELECT * FROM `product-list` WHERE id = ?");
    $stmt->execute([$_GET['id']]);
    $product = $stmt->fetch();

    if (!$product) {
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
            <input type="hidden" name="id" value="<?php echo $product['id']; ?>">
            <label>Product Name:</label><br>
            <input type="text" name="name" value="<?php echo htmlspecialchars($product['name']); ?>"><br><br>
            <label>Price (BDT):</label><br>
            <input type="text" name="price" value="<?php echo $product['price']; ?>"><br><br>
            <hr>
            <input type="submit" name="submit" value="Update">
        </fieldset>
    </form>
    <br>
    <a href="home.php">Back to Product List</a>

</body>
</html>
