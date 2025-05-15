<?php
include "connect.php";
session_start();
?>
<header>
    <?php
    if (isset($_POST['exit'])) {
        unset($_SESSION['user']);
        session_destroy();
        header("location: login.php");
    } ?>
    <div class="container">
        <ul>
            <?php
            if (isset($_SESSION['user'])) { ?>
                <form action="" method="POST">
                    <input name="exit" type="submit" value="Выйти">
                </form>
                <a href="requests.php">Заказы</a>
                <a href="create_request.php">Создать заказ</a>
            <?php } else { ?>
                <a href="login.php">Войти</a>
                <a href="index.php">Регистрация</a>
                <a href="requests.php">Заказы</a>
                <a href="create_request.php">Создать заказ</a>
            <?php } ?>


            <?php

            if (isset($_SESSION['user'])) {
                if (!empty($user)) {
                    $user = $_SESSION['user'];
                    if ($user['id_role'] == 2) {
                        ?>
                        <a href="admin.php">Админ</a>
                        <?php
                    }
                }
            }
            ?>
        </ul>
    </div>
</header>