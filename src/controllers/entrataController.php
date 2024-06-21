<?php

if(!isset($_SESSION['user'])){
    header("Location: /");
}
$stmt = $pdo->prepare("SELECT * FROM produtos");
$stmt->execute();
$products = $stmt->fetchAll();
// var_dump($products);
$smarty->assign("products", $products);
$smarty->display("entrada.html");