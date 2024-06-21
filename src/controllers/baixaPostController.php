<?php

if(!isset($_SESSION['user'])){
    header("Location: /");
}
$product = $_POST["product"];
$quantity = $_POST["quantity"];

$stmt = $pdo->prepare("UPDATE produtos SET quantity = quantity - :quantity WHERE Id = :product");
$stmt->bindParam(':product', $product);
$stmt->bindParam(':quantity', $quantity);

try {

    $stmt->execute();
    header("Location: /baixa");
 } catch (PDOException $e) {
    echo "Erro ao inserir registro: " . $e->getMessage();
}