<?php

if(!isset($_SESSION['user'])){
    header("Location: /");
}
$product = $_POST["product"];
$quantity = $_POST["quantity"];
$validade = $_POST["validade"];
$zv = $_POST["zv"];

if($product == "" || $quantity == "" || $validade == "" || $zv == "") {
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
                window.location = '/adicionar'; // Redireciona até a listagem
            });
        </script>
    </body>
    </html>";

    exit;
}

$validade = $util->formatarData($validade);

$stmt = $pdo->prepare("INSERT INTO produtos (product, quantity, validade, ZV) VALUES (:product, :quantity, :validade, :zv)");
$stmt->bindParam(':product', $product);
$stmt->bindParam(':quantity', $quantity);
$stmt->bindParam(':validade', $validade);
$stmt->bindParam(':zv', $zv);

try {

    $stmt->execute();
    // echo "Registro inserido com sucesso!";
    header("Location: /listagem");
} catch (PDOException $e) {
    echo "Erro ao inserir registro: " . $e->getMessage();
}