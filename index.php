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

//GET METHOD

$router->get("/", function() use ($smarty) {
    include 'src/controllers/indexController.php';
});

$router->get("/listagem", function() use($smarty, $pdo){
    include 'src/controllers/listagemController.php';
});

$router->get("/adicionar", function() use($smarty){
    include 'src/controllers/adicionarController.php';
});

$router->get("/baixa", function() use($smarty, $pdo){
    include 'src/controllers/baixaController.php';
});

$router->get("/entrada", function() use($smarty, $pdo){
    include 'src/controllers/entrataController.php';
});

//FIM GET METHOD

//POST METHOD

$router->post("/login", function() use ($pdo, $smarty) {
    include 'src/controllers/loginController.php';
});

$router->post("/cadastrar", function() use ($pdo){
    include 'src/controllers/cadastrarController.php';
});

$router->post("/produto/baixa", function() use ($pdo){
    include 'src/controllers/baixaPostController.php';
});

$router->post("/produto/entrada", function() use ($pdo){
    include 'src/controllers/entrataPostController.php';
});

//FIM POST METHOD

$router->dispatch();

if ($router->error()) {
    $router->redirect("/");
}