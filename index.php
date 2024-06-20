<?php
session_start();

require 'vendor/autoload.php';

use CoffeeCode\Router\Router;
use Smarty\Smarty;


$router = new Router("https://www.controledeestoque.shop/");

$smarty = new Smarty;
$smarty->setTemplateDir("templates");
$smarty->setCompileDir("templates_c");


include 'src/database/padrao.php';

$router->get("/", function() use ($smarty) {

    if (!isset($_SESSION['csrf_token'])) {
        $csrf_token = bin2hex(random_bytes(32));
        $_SESSION['csrf_token'] = $csrf_token;
    }else{
        $csrf_token =  $_SESSION['csrf_token'];
    }
    
    $smarty->assign("csrf", $csrf_token);
    $smarty->display("login.html");
});

$router->post("/login", function() use ($pdo, $smarty) {

    if($_SESSION['csrf_token'] == $_POST['token']){

        $username = $_POST["username"];
        $password = md5($_POST["password"]);
        $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE (name = :username AND cript_password = :password)");
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $password);
        $stmt->execute();
        $user = $stmt->fetch();
        if ($stmt->rowCount() > 0) {
            $_SESSION['user'] = $user;
            header("Location: /listagem");
        } else {
            header("Location: /");
        }
    }

});

$router->get("/listagem", function() use($smarty, $pdo){
    if(!isset($_SESSION['user'])){
        header("Location: /");
    }

    $stmt = $pdo->prepare("SELECT * FROM produtos");
    $stmt->execute();
    $products = $stmt->fetchAll();
    // var_dump($products);
    $smarty->assign("products", $products);
    $smarty->display("home.html");
});

$router->post("/cadastrar", function() use ($pdo){
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

});

$router->post("/data/{acao}", function($acao) use($pdo){
    if(!isset($_SESSION['user'])){
        header("Location: /");
    }

    require "src/api/data.php";

});

$router->dispatch();