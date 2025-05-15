<?php
include "connect.php";
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Заказы</title>
    <link rel="stylesheet" href="style.css">
</head>
<?php
if (isset($_SESSION['user'])) {
    $user = $_SESSION['user'];
} else {
    header("location: login.php");
}

// Запрос с JOIN для получения информации о заказах
$orders = $mysqli->query("
    SELECT *, product.name AS product_name, status.name AS status_name, product.price AS product_price
    FROM `order` 
    JOIN `product` ON order.id_product = product.id
    JOIN `status` ON order.id_status = status.id
    WHERE order.id_user = '$user[id]'
");

?>

<body>
    <div class="wrapper">
        <?php include "header.php"; ?>
        <main>
            <div class="container">
                <h1>Заказы</h1>
                <a href="create_request.php">Новый заказ</a>
                <div class="cards">
                    <?php foreach ($orders as $order) { ?>
                        <div class="card">
                            <h4><?= htmlspecialchars($order['product_name']); ?></h4>
                            <p>Цена: <?= htmlspecialchars($order['product_price']); ?></p>
                            <p>Статус: <?= htmlspecialchars($order['status_name']); ?></p>
                            <p>Количество: <?= htmlspecialchars($order['count']); ?></p>
                            <p>Адрес: <?= htmlspecialchars($order['address']); ?></p>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </main>
        <?php include "footer.php"; ?>
    </div>
</body>

</html>