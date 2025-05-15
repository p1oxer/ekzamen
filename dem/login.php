<?php
include "connect.php";
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Авторизация</title>
    <link rel="stylesheet" href="style.css">
</head>
<?php
$error = "";

if (!empty($_POST)) {
    $login = $_POST['login'];
    $password = md5($_POST['password']);
    if (empty($login) || empty($password)) {
        $error = "Заполните поля";
    } else {
        $query = "SELECT * FROM `user` WHERE `login` = '$login'";
        $result = $mysqli->query($query);

        if (mysqli_num_rows($result) > 0) {
            $user_info = mysqli_fetch_assoc($result);
            if ($user_info['password'] == $password) {
                $_SESSION['user'] = $user_info;
                $user_info['id_role'] == 2 ? header("location: admin.php") : header("location: requests.php");
            } else {
                $error = "Неправильный пароль";
            }

        } else {
            $error = "Нету пользователя";
        }
    }
    $mysqli->close();
}
?>

<body>
    <div class="wrapper">
        <?php include "header.php"; ?>
        <main>
            <div class="container">
                <h1>Авторизация</h1>
                <form method="POST" class="form">
                    <input type="text" name="login" placeholder="LOGIN" value="<?php htmlspecialchars($login ?? "", ENT_QUOTES); ?>">
                    <input type="password" name="password" placeholder="password" value="<?php htmlspecialchars($password ?? "", ENT_QUOTES); ?>">
                    <input type="submit" value="Авторизация">
                </form>
                <p style="color:red;"><?= $error ?></p>
            </div>
        </main>
        <?php include "footer.php"; ?>
    </div>
</body>

</html>