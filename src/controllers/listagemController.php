<?php 

if(!isset($_SESSION['user'])){
        header("Location: /");
    }

    $stmt = $pdo->prepare("SELECT * FROM produtos WHERE quantity > 0");
    $stmt->execute();
    $products = $stmt->fetchAll();

    $stmt2 = $pdo->prepare("SELECT * FROM produtos WHERE quantity < 15");
    $stmt2->execute();
    $quant = $stmt2->rowCount();
    $products2 = $stmt2->fetchAll();

    $smarty->assign("products", $products);
    $smarty->assign("quant", $quant);
    $smarty->assign("products2", $products2);
    $smarty->display("home.html");