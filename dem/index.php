<?php
include "connect.php";
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Регистрация</title>
    <link rel="stylesheet" href="style.css">
</head>
<?php
$error = "";
if (!empty($_POST)) {
    $login = $_POST['login'] ?? "";
    $password = md5($_POST['password']) ?? "";
    $email = $_POST['email'] ?? "";
    $name = $_POST['name'] ?? "";
    $phone = $_POST['phone'] ?? "";

    if (empty($login) || empty($password) || empty($email) || empty($name) || empty($phone)) {
        $error = "Заполните поля";
    } else {
        $query = "SELECT `login` FROM `user` WHERE `login` = '$login'";

        if (mysqli_num_rows($mysqli->query($query)) > 0) {
            $error = "Пользователь уже зареган";
        } else {
            $mysqli->query("INSERT INTO `user` (`id_role`,`login`,`password`,`email`,`full_name`,`phone`) VALUES ('1','$login','$password','$email','$name','$phone')");
            header("location: requests.php");
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
                <h1>Регистрация</h1>
                <form class="form" method="POST">
                    <input type="text" name="login" placeholder="LOGIN" value="<?php htmlspecialchars($login ?? "", ENT_QUOTES); ?>">
                    <input type="password" name="password" placeholder="password" value="<?php htmlspecialchars($password ?? "", ENT_QUOTES); ?>">
                    <input type="email" name="email" placeholder="email" value="<?php htmlspecialchars($email ?? "", ENT_QUOTES); ?>">
                    <input type="text" name="name" placeholder="name" value="<?php htmlspecialchars($name ?? "", ENT_QUOTES); ?>">
                    <input type="tel" name="phone" placeholder="phone" value="<?php htmlspecialchars($phone ?? "", ENT_QUOTES); ?>">
                    <input type="submit" value="Регистрация">
                </form>
                <p style="color:red;"><?= $error ?></p>
            </div>
        </main>
        <?php include "footer.php"; ?>
    </div>
</body>

</html>