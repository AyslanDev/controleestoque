<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require 'vendor/autoload.php';
require_once 'src/classes/Ultilidades.class.php';

use CoffeeCode\Router\Router;
use Smarty\Smarty;

$router = new Router("https://www.controledeestoque.shop/");

$smarty = new Smarty;
$smarty->setTemplateDir("templates");
$smarty->setCompileDir("templates_c");

$util = new Utilidades();

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

$router->get("/logout", function(){
    include 'src/controllers/logoutController.php';
});

//FIM GET METHOD

//POST METHOD

$router->post("/login", function() use ($pdo, $smarty) {
    include 'src/controllers/loginController.php';
});

$router->post("/cadastrar", function() use ($pdo, $util){
    include 'src/controllers/cadastrarController.php';
});

$router->post("/produto/baixa", function() use ($pdo){
    include 'src/controllers/baixaPostController.php';
});

$router->post("/produto/entrada", function() use ($pdo){
    include 'src/controllers/entrataPostController.php';
});

$router->post("/produto/editar", function() use ($pdo, $smarty, $util){
    include 'src/controllers/alterarPostController.php';
});

$router->post("/produto/delet", function() use ($pdo, $smarty){
    include 'src/controllers/deletPostController.php';
});

//FIM POST METHOD

$router->dispatch();

if ($router->error()) {
    $router->redirect("/");
}