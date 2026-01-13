<?php
    function tintas_carregarPor_identificacao($mysqli, $tintasIdentificacao) {
        $dados = $mysqli -> query("CALL tintas_carregarPor_identificacao('$tintasIdentificacao')");

        return $dados;
    }
?>