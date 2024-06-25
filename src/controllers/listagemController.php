<?php 

if(!isset($_SESSION['user'])){
        header("Location: /");
    }

    $stmt = $pdo->prepare("SELECT * FROM produtos WHERE quantity > 0");
    $stmt->execute();
    $products = $stmt->fetchAll();

    $stmt = $pdo->prepare("SELECT * FROM produtos WHERE quantity < ZV");
    $stmt->execute();
    $quant = $stmt->rowCount();
    $products2 = $stmt->fetchAll();

    $stmt = $pdo->prepare("SELECT * FROM produtos WHERE validade < NOW()");
    $stmt->execute();
    $vencidos = $stmt->rowCount();
    $products3 = $stmt->fetchAll();

    $smarty->assign("products", $products);
    $smarty->assign("quant", $quant);
    $smarty->assign("vencidos", $vencidos);
    $smarty->assign("products2", $products2);
    $smarty->assign("products3", $products3);
    $smarty->display("home.html");