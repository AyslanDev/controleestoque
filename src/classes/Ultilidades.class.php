<?php

class Utilidades{

    public function post($dados){
        return filter_input(INPUT_POST, $dados, FILTER_SANITIZE_SPECIAL_CHARS);
    }

    public function get($dados){
        return filter_input(INPUT_GET, $dados, FILTER_SANITIZE_SPECIAL_CHARS);
    }

}