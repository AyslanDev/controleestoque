<?php

if($_SESSION['csrf_token'] == $_POST['token']){

    $username = $_POST["username"];
    $password = md5($_POST["password"]);
    $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE (name = :username AND cript_password = :password)");
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':password', $password);
    $stmt->execute();
    $user = $stmt->fetch();
    if ($stmt->rowCount() > 0) {
        $_SESSION['user'] = $user;
        header("Location: /listagem");
    } else {
        header("Location: /");
    }
}