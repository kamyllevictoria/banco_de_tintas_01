<?php

    function gestor_carregarPor_email($mysqli, $email) {
        $dados = $mysqli -> query("CALL gestor_carregarPor_email('$email')");

        return $dados;
    }

    function clientes_adicionar($mysqli, $email, $foto, $telefone, $senhaHash, $Nome, $direcionamento, $tipoPessoa, $cpf, $cnpj) {
        $mysqli -> query("CALL clientes_adicionar('$email', '$foto', '$telefone', '$senhaHash', '$Nome', '$direcionamento', $tipoPessoa, '$cpf', '$cnpj')");
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

    function pessoasJuridicas_adicionar($mysqli, $cnpj, $clienteId) {
        $mysqli -> query("CALL pessoasJuridicas_adicionar('$cnpj', $clienteId)");
    }

    function pessoasJuridicas_carregarPor_cnpj($mysqli, $cnpj) {
        $dados = $mysqli -> query("CALL pessoasJuridicas_carregarPor_cnpj('$cnpj')");

        return $dados;
    }

    function pessoasFisicas_adicionar($mysqli, $cpf, $clienteId) {
        $mysqli -> query("CALL pessoasFisicas_adicionar('$cpf', $clienteId)");
    }

    function pessoasFisicas_carregarPor_cpf($mysqli, $cpf) {
        $dados = $mysqli -> query("CALL pessoasFisicas_carregarPor_cpf('$cpf')");

        return $dados;
    }

?>