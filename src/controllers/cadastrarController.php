<?php

if(!isset($_SESSION['user'])){
    header("Location: /");
}
$product = $_POST["product"];
$quantity = $_POST["quantity"];
$value = $_POST["value"];

$stmt = $pdo->prepare("INSERT INTO produtos (product, quantity, value) VALUES (:product, :quantity, :value)");
$stmt->bindParam(':product', $product);
$stmt->bindParam(':quantity', $quantity);
$stmt->bindParam(':value', $value);

try {

    $stmt->execute();
    // echo "Registro inserido com sucesso!";
    header("Location: /listagem");
} catch (PDOException $e) {
    echo "Erro ao inserir registro: " . $e->getMessage();
}