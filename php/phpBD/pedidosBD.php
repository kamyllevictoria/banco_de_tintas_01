<?php
    function pedidos_adicionar($mysqli, $dataHora, $volume, $clienteId, $tintasIdentificacao) {
        $mysqli -> query("CALL pedidos_adicionar('$dataHora', $volume, '$clienteId', '$tintasIdentificacao')");
    }

    function pedidos_carregarPor_tintasIdentificacao($mysqli, $identificacao) {
        $dados = $mysqli -> query("CALL pedidos_carregarPor_tintasIdentificacao('$identificacao')");

        return $dados;
    }

    function pedidoStatus_adicionar($mysqli, $dataHoraRetirada, $status, $observacoes, $gestorId, $pedidosDataHora, $dataHora, $tintasIdentificacao, $clienteId) {
        $mysqli -> query("CALL pedidoStatus_adicionar('$dataHoraRetirada', '$status', '$observacoes', $gestorId, '$pedidosDataHora', '$dataHora', '$tintasIdentificacao', $clienteId)");
    }
?>