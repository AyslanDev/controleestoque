<?php

if(!isset($_SESSION['user'])){
    header("Location: /");
}
$product = $_POST["product"];
$value = $_POST["value"];
$idProduto = $_POST["idProduto"];

$stmt = $pdo->prepare("UPDATE produtos SET product = :quantity AND value = :value WHERE Id = :id");
$stmt->bindParam(':product', $product);
$stmt->bindParam(':value', $value);
$stmt->bindParam(':id', $idProduto);

try {

    $stmt->execute();
    header("Location: /listagem");
 } catch (PDOException $e) {
    echo "Erro ao inserir registro: " . $e->getMessage();
}