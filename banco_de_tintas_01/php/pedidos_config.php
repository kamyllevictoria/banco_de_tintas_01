<?php
    require 'phpBD/conexaoBD.php';
    require 'phpBD/pedidosBD.php';
    require 'phpBD/tintasBD.php';
    require 'phpBD/listaDesejosBD.php';

    if(isset($_POST["fazer-pedido"])) {
        session_start();

        if($_POST["volume".$_POST["identificacao"]] != "") {
            if(isset($_POST["identificacao"])) {
                $tintasIdentificacao = $_POST["identificacao"];
            }
    
            if(isset($_POST["volume".$tintasIdentificacao])) {
                $volume = $_POST["volume".$tintasIdentificacao];
            }

            $tabela = tintas_carregarPor_identificacao($mysqli, $tintasIdentificacao);
            $linha = $tabela -> fetch_assoc();

            $clienteId = $_SESSION["USUARIO"];
            date_default_timezone_set('America/Sao_Paulo');
            $dataHora = date('Y-m-d H:i:s');

            if(floatval($volume) > floatval($linha["volume"])) {
                $_SESSION["mensagem-fazer-pedido"] = "A quantidade solicitada é maior do que o volume disponível para esta tinta!";
            }
            else {
                $mysqli -> next_result();
                pedidos_adicionar($mysqli, $dataHora, $volume, $clienteId, $tintasIdentificacao);
                
                $_SESSION["mensagem-fazer-pedido"] = "Pedido efetuado.";
            }
        }

        header("Location: ../index.php");
    }

    if(isset($_POST["aprovar-pedido"])) {
        session_start();

        if(isset($_POST["identificacao"])) {
            $tintasIdentificacao = $_POST["identificacao"];
        }

        if(isset($_POST["dataHora"])) {
            $pedidosDataHora = $_POST["dataHora"];
        }

        if(isset($_POST["clienteId"])) {
            $clienteId = $_POST["clienteId"];
        }

        if(isset($_POST["data_retirada".$tintasIdentificacao])) {
            $data = $_POST["data_retirada".$tintasIdentificacao];
        }

        if(isset($_POST["hora_retirada".$tintasIdentificacao])) {
            $hora = $_POST["hora_retirada".$tintasIdentificacao];
        }

        if(isset($_POST["observacoes".$tintasIdentificacao])) {
            $observacoes = $_POST["observacoes".$tintasIdentificacao];
        }

        if(isset($_POST["statusOpcoes".$tintasIdentificacao])) {
            $status = $_POST["statusOpcoes".$tintasIdentificacao];

            switch($status) {
                case "1":
                    $status = "Aprovado";
                break;

                case "2":
                    $status = "Parcialmente aprovado";
                break;

                case "3":
                    $status = "Reprovado";
                break;
            }
        }

        $gestorId = $_SESSION["ADM"];
        $dataHoraRetirada = $data." ".$hora;

        date_default_timezone_set('America/Sao_Paulo');
    
        $dataHora = date('Y-m-d H:i:s');

        if($status == "Aprovado" && ($data == "" || $hora == "")) {
            $_SESSION["mensagem-aprovar-pedido"] = "Informe uma data e uma hora para retirada do pedido aprovado!";
        }
        else if($status == "Parcialmente aprovado" && ($data == "" || $hora == "" || $observacoes == "")) {
            $_SESSION["mensagem-aprovar-pedido"] = "Informe uma data, uma hora e as observações para retirada do pedido parcialmente aprovado!";
        }
        else if($status == "Reprovado" && $observacoes == "") {
            $_SESSION["mensagem-aprovar-pedido"] = "Informe as observações do status do pedido reprovado!";
        }
        else if(strtotime($dataHoraRetirada) < strtotime($dataHora)) {
            $_SESSION["mensagem-aprovar-pedido"] = "A data e a hora de retirada devem ser posteriores à data e a hora de agora!";
        }
        else {
            pedidoStatus_adicionar($mysqli, $dataHoraRetirada, $status, $observacoes, $gestorId, $pedidosDataHora, $dataHora, $tintasIdentificacao, $clienteId);
            
            $_SESSION["mensagem-aprovar-pedido"] = "Status do pedido confirmado.";
        }

        header("Location: ../pedidos.php");
    }

    if(isset($_POST["lista-desejos"])) {
        session_start();

        if(isset($_POST["identificacao"])) {
            $identificacao = $_POST["identificacao"];
        }

        $tabela = tintas_carregarPor_identificacao($mysqli, $identificacao);
        $linha = $tabela -> fetch_assoc();

        $cor = $linha["cor"];

        date_default_timezone_set('America/Sao_Paulo');
        $data = date('Y-m-d H:i:s');

        $clienteId = $_SESSION["USUARIO"];

        $mysqli -> next_result();
        listaDesejos_adicionar($mysqli, $data, $clienteId, $identificacao, $cor);

        header("Location: ../opcoes.php?acao=todos&valor=todos&page=1");
    }

    if(isset($_POST["remover-lista-desejos"])) {
        session_start();

        if(isset($_POST["cor"])) {
            $cor = $_POST["cor"];
        }

        listaDesejos_remover($mysqli, $cor);

        header("Location: ../usuario.php");
    }
?>