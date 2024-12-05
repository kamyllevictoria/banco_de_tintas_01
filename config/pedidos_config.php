<?php

    if(isset($_POST["fazer-pedido"])) {
        fazerPedido();

        header("Location: ../index.php");
    }

    if(isset($_POST["aprovar-pedido"])) {
        aprovarPedido();

        header("Location: ../pedidos.php");
    }

    if(isset($_POST["lista-desejos"])) {
        listaDesejos();

        header("Location: ../opcoes.php?acao=todos&valor=todos&page=1");
    }

    if(isset($_POST["remover-lista-desejos"])) {
        removerListaDesejos();

        header("Location: ../usuario.php");
    }

    function fazerPedido() {
        session_start();

        if($_POST["volume".$_POST["identificacao"]] != "") {
            if(isset($_POST["identificacao"])) {
                $tintasIdentificacao = $_POST["identificacao"];
            }
    
            if(isset($_POST["volume".$tintasIdentificacao])) {
                $volume = $_POST["volume".$tintasIdentificacao];
            }

            $conexao = mysqli_connect("localhost", "root", "","banco_tintas") or die ("Falha na conexão");
            $tabela = mysqli_query($conexao, "CALL tintas_carregarPor_identificacao('$tintasIdentificacao')");
            $linha = mysqli_fetch_array($tabela);
            mysqli_close($conexao);
    
            $clienteId = $_SESSION["USUARIO"];
    
            date_default_timezone_set('America/Sao_Paulo');
    
            $dataHora = date('Y-m-d H:i:s');

            if(floatval($volume) > floatval($linha["volume"])) {
                $_SESSION["mensagem-fazer-pedido"] = "A quantidade solicitada é maior do que o volume disponível para esta tinta!";
            }
            else {
                $conexao = mysqli_connect("localhost", "root", "","banco_tintas") or die ("Falha na conexão");
    
                mysqli_query($conexao, "CALL pedidos_adicionar('$dataHora', $volume, '$clienteId', '$tintasIdentificacao')");
    
                mysqli_close($conexao);
    
                $_SESSION["mensagem-fazer-pedido"] = "Pedido efetuado.";
            }
        }
    }

    function aprovarPedido() {
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
            $conexao = mysqli_connect("localhost", "root", "","banco_tintas") or die ("Falha na conexão");

            mysqli_query($conexao, "CALL pedidoStatus_adicionar('$dataHoraRetirada', '$status', '$observacoes', '$gestorId', '$pedidosDataHora', '$dataHora', '$tintasIdentificacao', '$clienteId')");

            mysqli_close($conexao);

            $_SESSION["mensagem-aprovar-pedido"] = "Status do pedido confirmado.";
        }

    }

    function listaDesejos() {
        session_start();

        if(isset($_POST["identificacao"])) {
            $identificacao = $_POST["identificacao"];
        }

        $conexao = mysqli_connect("localhost", "root", "","banco_tintas") or die ("Falha na conexão");
        $tabela = mysqli_query($conexao, "CALL tintas_carregarPor_identificacao('$identificacao')");
        $linha = mysqli_fetch_array($tabela);
        mysqli_close($conexao);

        $cor = $linha["cor"];

        date_default_timezone_set('America/Sao_Paulo');
        $data = date('Y-m-d H:i:s');

        $clienteId = $_SESSION["USUARIO"];

        $conexao = mysqli_connect("localhost", "root", "","banco_tintas") or die ("Falha na conexão");
        mysqli_query($conexao, "CALL listaDesejos_adicionar('$data', $clienteId, '$identificacao', '$cor')");
        mysqli_close($conexao);
    }

    function removerListaDesejos() {
        session_start();

        if(isset($_POST["cor"])) {
            $cor = $_POST["cor"];
        }

        $conexao = mysqli_connect("localhost", "root", "","banco_tintas") or die ("Falha na conexão");
        mysqli_query($conexao, "CALL listaDesejos_remover('$cor')");
        mysqli_close($conexao);
    }
?>