<?php

$host = '127.0.0.1';
$dbname = 'u636734268_estoque';
$username = 'u636734268_estoque';
$password = 'DbEstoque2024%#';


$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, 
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, 
    PDO::ATTR_EMULATE_PREPARES => false, 
];

try {

    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password, $options);

} catch (PDOException $e) {

    die("Erro ao conectar ao banco de dados: " . $e->getMessage());
}
?>
