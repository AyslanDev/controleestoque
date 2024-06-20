<?php
//carrega todas as classe
$autoload = spl_autoload_register(function ($classes) {
        require "$classes.class.php";
}) ;