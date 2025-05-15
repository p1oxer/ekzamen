<?php
include "connect.php";
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Админ</title>
    <link rel="stylesheet" href="style.css">
</head>
<?php
if (isset($_SESSION['user'])) {
    $user = $_SESSION['user'];
    if ($user["id_role"] == 1) {
        header("location: requests.php");
    }
} else {
    header("location: login.php");
}


?>

<body>
    <div class="wrapper">
        <?php include "header.php"; ?>
        <main>
            <div class="container">
                <h1>Админ панель</h1>
            </div>
        </main>
        <?php include "footer.php"; ?>
    </div>
</body>

</html>