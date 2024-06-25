<?php

if(!isset($_SESSION['user'])){
    header("Location: /");
}

if($_POST["product"] == "" || $_POST["value"] == "" || $_POST["idProduto"] == "") {
    header("Location: /listagem");
    exit;
}

$product = $_POST["product"];
$value = $_POST["value"];
$idProduto = $_POST["idProduto"];

try {
    $sql = $pdo->prepare("UPDATE produtos SET product = :product, value = :value WHERE Id = :id");

    $sql->bindParam(':product', $product, PDO::PARAM_STR);
    $sql->bindParam(':value', $value, PDO::PARAM_STR);
    $sql->bindParam(':id', $idProduto, PDO::PARAM_INT);

    $sql->execute();
  
    echo "
    <!DOCTYPE html>
    <html lang='en'>
    <head>
        <script src='https://cdn.jsdelivr.net/npm/sweetalert2@10'></script>
    </head>
    <body>
        <script>
            Swal.fire({
                title: 'Sucesso!',
                text: 'Sua operação foi bem-sucedida.',
                icon: 'success'
            }).then(function() {
                window.location = '/listagem'; // Redireciona após o alerta
            });
        </script>
    </body>
    </html>";


} catch (PDOException $e) {
    echo "
    <!DOCTYPE html>
    <html lang='en'>
    <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <title>Erro</title>
        <script src='https://cdn.jsdelivr.net/npm/sweetalert2@10'></script>
    </head>
    <body>
        <script>
            Swal.fire({
                title: 'Erro!',
                text: 'Erro ao atualizar registro: " . $e->getMessage() . "',
                icon: 'error'
            });
        </script>
    </body>
    </html>";
}