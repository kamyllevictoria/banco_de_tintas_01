<?php

    function gestor_carregarPor_email($mysqli, $email) {
        $dados = $mysqli -> query("CALL gestor_carregarPor_email('$email')");

        return $dados;
    }

    function clientes_adicionar($mysqli, $email, $foto, $telefone, $senhaHash, $Nome, $direcionamento, $tipoPessoa, $cpf, $cnpj, $ativo) {
        $mysqli -> query("CALL clientes_adicionar('$email', '$foto', '$telefone', '$senhaHash', '$Nome', '$direcionamento', $tipoPessoa, '$cpf', '$cnpj', $ativo)");
    }

    function clientes_atualizar($mysqli, $id, $email, $foto, $telefone, $senhaHash, $nome, $direcionamento) {
        $mysqli -> query("CALL clientes_atualizar($id, '$email', '$foto', '$telefone', '$senhaHash', '$nome', '$direcionamento')");
    }

    function clientes_carregarPor_id($mysqli, $id) {
        $dados = $mysqli -> query("CALL clientes_carregarPor_id($id)");

        return $dados;
    }

    function clientes_carregarPor_email($mysqli, $email) {
        $dados = $mysqli -> query("CALL clientes_carregarPor_email('$email')");

        return $dados;
    }

    function clientes_carregarPor_cpf($mysqli, $cpf) {
        $dados = $mysqli -> query("CALL clientes_carregarPor_cpf('$cpf')");

        return $dados;
    }

    function clientes_carregarPor_cnpj($mysqli, $cnpj) {
        $dados = $mysqli -> query("CALL clientes_carregarPor_cnpj('$cnpj')");

        return $dados;
    }

    function clientes_atualizar_ativo($mysqli, $id, $ativo) {
        $mysqli -> query("CALL clientes_atualizar_ativo($id, $ativo)");
    }

    function clientes_atualizar_senha($mysqli, $id, $novaSenhaHash) {
        $mysqli -> query("CALL clientes_atualizar_senha($id, '$novaSenhaHash')");
    }

    function recuperarSenha_adicionar($mysqli, $clienteId, $codigo, $dataHoraExpiracao, $valido) {
        $mysqli -> query("CALL recuperarSenha_adicionar($clienteId, '$codigo', '$dataHoraExpiracao', $valido)");
    }

    function recuperarSenha_consultarDataHoraExpiracao($mysqli, $clienteId) {
        $mysqli -> query("CALL recuperarSenha_consultarDataHoraExpiracao($clienteId)");
    }
    
    function recuperarSenha_expirar_valido($mysqli, $clienteId) {
        $mysqli -> query("CALL recuperarSenha_expirar_valido($clienteId)");
    }
?>