<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../css/style.css">
        <title>Document</title>
    </head>
    <body>

        <?php
            session_start();
            if ($_SESSION["onSystem"] == "on") {
                $_SESSION["onSystem"] = "on";
                include_once("headerWithReg.php");
            } else {
                include_once("headerNoReg.php");
            }

            if (!isset($_POST["signIn"])) {
        ?>

        <form action="signIn.php" method="POST">
            <label>Логин: </label>
            <input type="text" name="login">
            <label>Пароль: </label>
            <input type="password" name="pass">
            <input type="submit" value="Войти" name="signIn">
        </form>

        <?php
            } else {
                include_once("../scripts/connect.php");
            }
        ?>

    </body>
</html>