<?php
    function pedidos_adicionar($mysqli, $dataHora, $volume, $clienteId, $tintasIdentificacao) {
        $mysqli -> query("CALL pedidos_adicionar('$dataHora', $volume, $clienteId, '$tintasIdentificacao')");
    }

    function pedidos_carregarPor_tintasIdentificacao($mysqli, $identificacao) {
        $dados = $mysqli -> query("CALL pedidos_carregarPor_tintasIdentificacao('$identificacao')");

        return $dados;
    }

    function pedidos_carregarPor_clienteId($mysqli, $clienteId) {
        $dados = $mysqli -> query("CALL pedidos_carregarPor_clienteId($clienteId)");

        return $dados;
    }

    function pedidoStatus_adicionar($mysqli, $dataHoraRetirada, $status, $observacoes, $gestorId, $pedidosDataHora, $dataHora, $tintasIdentificacao, $clienteId) {
        $mysqli -> query("CALL pedidoStatus_adicionar('$dataHoraRetirada', '$status', '$observacoes', $gestorId, '$pedidosDataHora', '$dataHora', '$tintasIdentificacao', $clienteId)");
    }

    function pedidoStatus_carregarPor_pedidosIds($mysqli, $dataHora, $tintasIdentificacao, $clienteId) {
        $dados = $mysqli -> query("CALL pedidoStatus_carregarPor_pedidosIds($mysqli, '$dataHora', '$tintasIdentificacao', $clienteId)");

        return $dados;
    }
?>