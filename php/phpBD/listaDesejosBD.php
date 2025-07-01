<?php
    function listaDesejos_adicionar($mysqli, $data, $clienteId, $identificacao, $cor) {
        $mysqli -> query("CALL listaDesejos_adicionar('$data', $clienteId, '$identificacao', '$cor')");
    }

    function listaDesejos_carregarPor_clienteId($mysqli, $clienteId) {
        $dados = $mysqli -> query("CALL listaDesejos_carregarPor_clienteId($clienteId)");

        return $dados;
    }

    function listaDesejos_remover($mysqli, $cor) {
        $mysqli -> query("CALL listaDesejos_remover('$cor')");
    }
?>