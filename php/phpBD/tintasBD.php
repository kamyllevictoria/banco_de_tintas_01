<?php
    function tintas_adicionar($mysqli, $identificacao, $dataVencimento, $marca, $caminho, $volume, $cor, $dataRecebimento) {
        $mysqli -> query("CALL tintas_adicionar('$identificacao', '$dataVencimento', '$marca', '$caminho', $volume, '$cor', '$dataRecebimento')");
    }

    function tintas_remover($mysqli, $identificacao) {
        $mysqli -> query("CALL tintas_remover('$identificacao')");
    }

    function tintas_atualizar($mysqli, $identificacao, $dataVencimento, $marca, $imagem, $volume, $cor, $dataRecebimento) {
        $mysqli -> query("CALL tintas_atualizar('$identificacao', '$dataVencimento', '$marca', '$imagem', $volume, '$cor', '$dataRecebimento')");
    }

    function tintas_carregar($mysqli) {
        $dados = $mysqli -> query("CALL tintas_carregar()");

        return $dados;
    }

    function tintas_carregar_marcas($mysqli) {
        $dados = $mysqli -> query("CALL tintas_carregar_marcas()");

        return $dados;
    }

    function tintas_carregarPor_identificacao($mysqli, $identificacao) {
        $dados = $mysqli -> query("CALL tintas_carregarPor_identificacao('$identificacao')");

        return $dados;
    }

    function tintas_carregarPor_corLike($mysqli, $cor) {
        $dados = $mysqli -> query("CALL tintas_carregarPor_corLike('$cor')");

        return $dados;
    }
?>