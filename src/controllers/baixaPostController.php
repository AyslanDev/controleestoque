<?php

if(!isset($_SESSION['user'])){
    header("Location: /");
}
$product = $_POST["product"];
$quantity = $_POST["quantity"];

$stmt = $pdo->prepare("SELECT quantity from produtos WHERE Id = :id");
$stmt->bindParam(':id', $product, PDO::PARAM_INT);
$stmt->execute();
$quantidade = $stmt->fetchColumn();

if($product == "" || $quantity == "") {
    echo "
    <!DOCTYPE html>
    <html lang='en'>    
    <head>
        <script src='https://cdn.jsdelivr.net/npm/sweetalert2@10'></script>
    </head>
    <body>
        <script>
            Swal.fire({
                title: 'Opss!',
                text: 'Preencha todos os campos.',
                icon: 'error'
            }).then(function() {
                window.location = '/entrada'; // Redireciona até a listagem
            });
        </script>
    </body>
    </html>";

    exit;
}

if($quantidade < $quantity) {
    echo "
    <!DOCTYPE html>
    <html lang='en'>    
    <head>
        <script src='https://cdn.jsdelivr.net/npm/sweetalert2@10'></script>
    </head>
    <body>
        <script>
            Swal.fire({
                title: 'Ops!',
                text: 'Valor a dar baixa é maior que a quantidade em estoque.',
                icon: 'error'
            }).then(function() {
                window.location = '/listagem'; // Redireciona até a listagem
            });
        </script>
    </body>
    </html>";

    exit;
}

$stmt = $pdo->prepare("UPDATE produtos SET quantity = quantity - :quantity WHERE Id = :product");
$stmt->bindParam(':product', $product);
$stmt->bindParam(':quantity', $quantity);

try {

    $stmt->execute();

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
                window.location = '/listagem'; // Redireciona até a listagem
            });
        </script>
    </body>
    </html>";

 } catch (PDOException $e) {
    echo "Erro ao inserir registro: " . $e->getMessage();
}