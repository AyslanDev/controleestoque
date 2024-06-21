<?php

if(!isset($_SESSION['user'])){
    header("Location: /");
}
$stmt = $pdo->prepare("SELECT * FROM produtos WHERE quantity > 0");
$stmt->execute();
$products = $stmt->fetchAll();
// var_dump($products);
$smarty->assign("products", $products);
$smarty->display("baixa.html");