<?php
    function tintas_carregarPor_identificacao($mysqli, $identificacao) {
        $dados = $mysqli -> query("CALL tintas_carregarPor_identificacao('$identificacao')");

        return $dados;
    }

    function tintas_carregarPor_cor($mysqli, $cor) {
        $dados = $mysqli -> query("CALL tintas_carregarPor_cor('$cor')");

        return $dados;
    }

    function tintas_carregarPor_marca($mysqli, $marca) {
        $dados = $mysqli -> query("CALL tintas_carregarPor_marca('$marca')");

        return $dados;
    }

    function tintas_adicionar($mysqli, $identificacao, $dataVencimento, $marca, $caminho, $volume, $cor, $dataRecebimento) {
        $mysqli -> query("CALL tintas_adicionar('$identificacao', '$dataVencimento', '$marca', '$caminho', $volume, '$cor', '$dataRecebimento')");
    }

    function tintas_remover($mysqli, $identificacao) {
        $mysqli -> query("CALL tintas_remover('$identificacao')");
    }

    function tintas_atualizar($mysqli, $identificacao, $dataVencimento, $marca, $imagem, $volume, $cor, $dataRecebimento) {
        $mysqli -> query("CALL tintas_atualizar('$identificacao', '$dataVencimento', '$marca', '$imagem', $volume, '$cor', '$dataRecebimento')");
    }
?>