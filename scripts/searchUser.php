<?php
    $login = trim($_POST["login"]);
    $email = trim($_POST["email"]);
    $pass = md5(trim($_POST["pass"]));

    $searchUserSql = "SELECT * FROM users";
    $data = $link->query($searchUserSql);
    $loginCoincidence = FALSE;
    $emailCoincidence = FALSE;
    $passCoincidence = FALSE;
    foreach ($data as $user) {
        $userLogin = $user["Login"];
        $userEmail = $user["Email"];
        $userPass = $user["Password"];
        if ($login == $userLogin or $login == "users") {
            $loginCoincidence = TRUE;
        }
        if ($email == $userEmail) {
            $emailCoincidence = TRUE;
        }
        if ($pass == $userPass) {
            $passCoincidence = TRUE;
        }
        if ($loginCoincidence == TRUE or $emailCoincidence == TRUE) {
            break;
        }
    }

    if (isset($_POST["reg"]) and !$loginCoincidence and !$emailCoincidence) {
        $insertUser = "INSERT INTO `users`(`Login`, `Email`, `Password`) VALUES ('$login', '$email', '$pass')";
        $res = $link->query($insertUser);
        if ($res === FALSE) {
            echo($link->errno." ".$link->error);
        } else {
            echo("Вы зарегистрировались. Пожалуйста, авторизуйтесь");
            $_SESSION["login"] = $login;
        }
    } elseif (isset($_POST["reg"]) and $loginCoincidence) {
        echo("Этот логин уже используется");
    } elseif (isset($_POST["reg"]) and $emailCoincidence) {
        echo("Этот Email Уже используется");
    } elseif (isset($_POST["signIn"]) and $loginCoincidence and $passCoincidence) {
        $_SESSION["onSystem"] = "on";
        $_SESSION["login"] = $login;
        header("Location: ../pages/profile.php");
    } elseif (isset($_POST["signIn"]) and $loginCoincidence) {
        echo("Неверный пароль");
    } elseif (isset($_POST["signIn"])) {
        echo("Пожалуйста, зарегистрируйтесь");
    }

?>