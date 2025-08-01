<?php
    require 'phpBD/conexaoBD.php';
    require 'phpBD/tintasBD.php';
    require 'phpBD/pedidosBD.php';
    require 'phpBD/utilitarios.php';

    if(isset($_POST["cadastrar-tinta"])) {
        session_start();

        $identificacao = $_POST["identificacao"];
        $cor = $_POST["cor"];
        $marca = $_POST["marca"];
        $dataVencimento = $_POST["dataVencimento"];
        $dataRecebimento = $_POST["dataRecebimento"];
        $volume = $_POST["volume"];

        if(isset($_FILES['imagem'])) {
            $imagem = $_FILES['imagem'];

            $caminho = gravarImagem($imagem);
        }

        $tabela = tintas_carregarPor_identificacao($mysqli, $identificacao);

        date_default_timezone_set('America/Sao_Paulo');
        $dataAgora = date('Y-m-d');

        if($tabela -> num_rows > 0) {
            $_SESSION["mensagem-cadastrar-tinta"] = "Esta identificação já está em uso. Informe uma identificação nova!";
        }
        else if(strtotime($dataVencimento) < strtotime($dataAgora)) {
            $_SESSION["mensagem-cadastrar-tinta"] = "A data de validade não pode ser anterior à data de hoje. A tinta está vencida!";
        }
        else if(strtotime($dataRecebimento) > strtotime($dataAgora)) {
            $_SESSION["mensagem-cadastrar-tinta"] = "A data de recebimento não pode estar no futuro. Informe a data de hoje ou anterior a ela!";
        }
        else {
            $mysqli -> next_result();
            tintas_adicionar($mysqli, $identificacao, $dataVencimento, $marca, $caminho, $volume, $cor, $dataRecebimento);

            $_SESSION["mensagem-cadastrar-tinta"] = "Tinta cadastrada.";
        }

        header("Location: ../cadastrar_tinta.php");
    }

    if(isset($_POST["apagar-tinta"])) {
        session_start();

        $identificacao = $_POST["identificacao"];

        $pedidos = pedidos_carregarPor_tintasIdentificacao($mysqli, $identificacao);

        if($pedidos -> num_rows > 0) {
            $_SESSION["mensagem-alterar-tinta"] = "Não foi possível deletar esta tinta. Existem pedidos para ela!";
        }
        else {
            $mysqli -> next_result();
            $tabela = tintas_carregarPor_identificacao($mysqli, $identificacao);
            $linha = $tabela -> fetch_assoc();
    
            removerImagem($linha["imagem"]);
    
            $mysqli -> next_result();
            tintas_remover($mysqli, $identificacao);
        }

        header("Location: ../catalogo.php");
    }

    if(isset($_POST["alterar-tinta"])) {
        session_start();

        $identificacao = $_POST["identificacao"];

        $tabela = tintas_carregarPor_identificacao($mysqli, $identificacao);

        $dataVencimento1;
        $marca1;
        $imagem;
        $cor;
        $dataRecebimento1;
        $volume1;

        while ($linha = $tabela -> fetch_assoc()) {
            $dataVencimento1 = $linha['dataValidade'];
            $marca1 = $linha['marca'];
            $imagem = $linha['imagem'];
            $cor = $linha['cor'];
            $dataRecebimento1 = $linha['dataRecebimento'];
            $volume1 = $linha['volume'];
        }
        
        if(isset($_POST["volume".$identificacao])) {
            $volume = $_POST["volume".$identificacao];

            if($volume == "") {
                $volume = $volume1;
            }
        }

        if(isset($_POST["marca".$identificacao])) {
            $marca = $_POST["marca".$identificacao];

            if($marca == "") {
                $marca = $marca1;
            }
        }
    
        if(isset($_POST["dataVencimento".$identificacao])) {
            $dataVencimento = $_POST["dataVencimento".$identificacao];

            if($dataVencimento == "") {
                $dataVencimento = $dataVencimento1;
            }
        }
    
        if(isset($_POST["dataRecebimento".$identificacao])) {
            $dataRecebimento = $_POST["dataRecebimento".$identificacao];

            if($dataRecebimento == "") {
                $dataRecebimento = $dataRecebimento1;
            }
        }

        date_default_timezone_set('America/Sao_Paulo');
    
        $dataAgora = date('Y-m-d');

        if(strtotime($dataVencimento) < strtotime($dataAgora)) {
            $_SESSION["mensagem-alterar-tinta"] = "A data de validade não pode ser anterior à data de hoje. A tinta está vencida!";
        }
        else if(strtotime($dataRecebimento) > strtotime($dataAgora)) {
            $_SESSION["mensagem-alterar-tinta"] = "A data de recebimento não pode estar no futuro. Informe a data de hoje ou anterior a ela!";
        }
        else {
            $mysqli -> next_result();
            tintas_atualizar($mysqli, $identificacao, $dataVencimento, $marca, $imagem, $volume, $cor, $dataRecebimento);

            $_SESSION["mensagem-alterar-tinta"] = "Tinta alterada.";
        }
        
        header("Location: ../catalogo.php");
    }

    if(isset($_POST["busca"])) {
        $valor = $_POST["pesquisa"];

        $tabelaCor = tintas_carregarPor_cor($mysqli, $cor);
        $mysqli -> next_result();

        $tabelaMarca = tintas_carregarPor_marca($mysqli, $marca);

        if($tabelaCor -> num_rows > 0) {
            header("Location: ../opcoes.php?acao=cor&valor=".$valor."&page=1");
        }
        else if($tabelaMarca -> num_rows > 0) {
            header("Location: ../opcoes.php?acao=marca&valor=".$valor."&page=1");
        }
        else {
            header("Location: ../opcoes.php?acao=todos&valor=todos&page=1");
        }
    }

    if(isset($_POST["filtrar-opcoes"])) {
        $cores = tintas_carregar_cores($mysqli);
        $mysqli -> next_result();

        $marcas = tintas_carregar_marcas($mysqli);
        $mysqli -> next_result();

        $tintas = tintas_carregar($mysqli);
        $mysqli -> next_result();

        
    }
?>