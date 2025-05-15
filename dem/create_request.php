<?php
include "connect.php";
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Оформить заказ</title>
    <link rel="stylesheet" href="style.css">
</head>
<?php
if (isset($_SESSION['user'])) {
    $user = $_SESSION['user'];
} else {
    header("location: login.php");
}
?>

<body>
    <?php
    $products = $mysqli->query("SELECT * FROM `product`");
    $error = "";
    if (!empty($_POST)) {
        $count = $_POST['count'] ?? "";
        $address = $_POST['address'] ?? "";
        $product_id = $_POST['product_id'] ?? "";

        if (!empty($count) || !empty($address)) {
            $mysqli->query("INSERT INTO `order` (`id_user`,`id_product`, `id_status`, `count`, `address`) VALUES ('$user[id]', '$product_id', '1', '$count', '$address')");
            header("location: requests.php");
        } else {
            $error = "Заполните поля";
        }
        $mysqli->close();
    }
    ?>
    <div class="wrapper">
        <?php include "header.php"; ?>
        <main>
            <div class="container">
                <h1>Оформить заказ</h1>
                <div class="cards">
                    <?php foreach ($products as $product) { ?>
                        <div class="card">
                            <h4><?= $product['name']; ?></h4>
                            <p>Цена:<?= $product['price']; ?></p>
                            <form action="" method="post" class="form">
                                <input type="hidden" name="product_id" value="<?= $product['id']; ?>">
                                <input placeholder="Количество" type="number" name="count" value="<?php htmlspecialchars($count ?? "", ENT_QUOTES); ?>">
                                <input placeholder="Адрес" type="text" name="address" value="<?php htmlspecialchars($address ?? "", ENT_QUOTES); ?>">
                                <input type="submit" value="Заказать">
                            </form>
                        </div>
                    <?php } ?>
                </div>
                <p style="color:red;"><?= $error ?></p>

            </div>
        </main>
        <?php include "footer.php"; ?>
    </div>
</body>

</html>