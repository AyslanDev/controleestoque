<?php   
if(!isset($_SESSION['user'])){
        header("Location: /");
    }
    $smarty->display("cadastro.html");