<?php

class Utilidades{

    public function post($dados){
        return filter_input(INPUT_POST, $dados, FILTER_SANITIZE_SPECIAL_CHARS);
    }

    public function get($dados){
        return filter_input(INPUT_GET, $dados, FILTER_SANITIZE_SPECIAL_CHARS);
    }

    function formatarData($data) {
        // Criar um objeto DateTime a partir da string de data
        $data_obj = DateTime::createFromFormat('d/m/Y', $data);
    
        // Verificar se a data foi criada corretamente
        if ($data_obj !== false) {
            // Converter para o formato yyyy-mm-dd
            return $data_obj->format('Y-m-d');
        } else {
            // Retornar um valor padrão ou mensagem de erro
            return "Formato de data inválido.";
        }
    }
}