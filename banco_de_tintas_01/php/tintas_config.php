<?php
    if(isset($_POST["cadastrar-tinta"])) {
        cadastrarTinta();

        header("Location: ../cadastrar_tinta.php");
    }

    if(isset($_POST["apagar-tinta"])) {
        apagarTinta();
    }

    if(isset($_POST["alterar-tinta"])) {
        alterarTinta();
        
        header("Location: ../catalogo.php");
    }

    if(isset($_POST["busca"])) {
        buscar();
        
        
    }

    function buscar() {
        $valor = $_POST["pesquisa"];

        $conexao = mysqli_connect("localhost", "root", "","banco_tintas") or die ("Falha na conexão");
        $tabelaCor = mysqli_query($conexao, "CALL tintas_carregarPor_cor('$valor')");
        mysqli_close($conexao);

        $conexao = mysqli_connect("localhost", "root", "","banco_tintas") or die ("Falha na conexão");
        $tabelaMarca = mysqli_query($conexao, "CALL tintas_carregarPor_marca('$valor')");
        mysqli_close($conexao);


        if(mysqli_num_rows($tabelaCor) > 0) {
            header("Location: ../opcoes.php?acao=cor&valor=".$valor."&page=1");
        }
        else if(mysqli_num_rows($tabelaMarca) > 0) {
            header("Location: ../opcoes.php?acao=marca&valor=".$valor."&page=1");
        }
        else {
            header("Location: ../opcoes.php?acao=todos&valor=todos&page=1");
        }
    }

    function cadastrarTinta() {
        session_start();

        $conexao = mysqli_connect("localhost", "root", "","banco_tintas") or die ("Falha na conexão");
        $caminho = "";

        if(isset($_POST["identificacao"])) {
            $identificacao = $_POST["identificacao"];
        }

        if(isset($_POST["cor"])) {
            $cor = $_POST["cor"];
        }
    
        if(isset($_POST["marca"])) {
            $marca = $_POST["marca"];
        }
    
        if(isset($_POST["dataVencimento"])) {
            $dataVencimento = $_POST["dataVencimento"];
        }
    
        if(isset($_POST["dataRecebimento"])) {
            $dataRecebimento = $_POST["dataRecebimento"];
        }
    
        if(isset($_POST["volume"])) {
            $volume = $_POST["volume"]; 
        }

        if(isset($_FILES['imagem'])) {
            $imagem = $_FILES['imagem'];

            $pasta = "../img-bd/";
            $nomeImagem = $imagem['name'];
            $novoNome = uniqid();
            $extensao = strtolower(pathinfo($nomeImagem, PATHINFO_EXTENSION));

            move_uploaded_file($imagem['tmp_name'], $pasta . $novoNome . "." . $extensao);

            $caminho = "img-bd/" . $novoNome . "." . $extensao;
        }

        $tabela = mysqli_query($conexao, "CALL tintas_carregarPor_identificacao('$identificacao')");
        $qtd_linhas = mysqli_num_rows($tabela);
        mysqli_close($conexao);

        date_default_timezone_set('America/Sao_Paulo');
    
        $dataAgora = date('Y-m-d');

        if($qtd_linhas > 0) {
            $_SESSION["mensagem-cadastrar-tinta"] = "Esta identificação já está em uso. Informe uma identificação nova!";
        }
        else if(strtotime($dataVencimento) < strtotime($dataAgora)) {
            $_SESSION["mensagem-cadastrar-tinta"] = "A data de validade não pode ser anterior à data de hoje. A tinta está vencida!";
        }
        else if(strtotime($dataRecebimento) > strtotime($dataAgora)) {
            $_SESSION["mensagem-cadastrar-tinta"] = "A data de recebimento não pode estar no futuro. Informe a data de hoje ou anterior a ela!";
        }
        else {
            $conexao = mysqli_connect("localhost", "root", "","banco_tintas") or die ("Falha na conexão");
            mysqli_query($conexao, "CALL tintas_adicionar('$identificacao', '$dataVencimento', '$marca', '$caminho', $volume, '$cor', '$dataRecebimento')");
            mysqli_close($conexao);

            $_SESSION["mensagem-cadastrar-tinta"] = "Tinta cadastrada.";
        }
    }
 
    function apagarTinta() {
        session_start();

        $conexao = mysqli_connect("localhost", "root", "","banco_tintas") or die ("Falha na conexão");

        if(isset($_POST["identificacao"])) {
            $identificacao = $_POST["identificacao"];
        }

        $pedidos = mysqli_query($conexao, "CALL pedidos_carregarPor_tintasIdentificacao('$identificacao')");

        if(mysqli_num_rows($pedidos) > 0) {
            $_SESSION["mensagem-alterar-tinta"] = "Não foi possível deletar esta tinta. Existem pedidos para ela!";
            header("Location: ../catalogo.php");
        }
        else {
            $conexao = mysqli_connect("localhost", "root", "","banco_tintas") or die ("Falha na conexão");
            $tabela = mysqli_query($conexao, "CALL tintas_carregarPor_identificacao('$identificacao')");
            $linha = mysqli_fetch_array($tabela);
    
            unlink("../".$linha["imagem"]);
    
            mysqli_close($conexao);
    
            $conexao = mysqli_connect("localhost", "root", "","banco_tintas") or die ("Falha na conexão");
    
            mysqli_query($conexao, "CALL tintas_remover('$identificacao')");
    
            mysqli_close($conexao);

            header("Location: ../catalogo.php");
        }
    }

    function alterarTinta() {
        session_start();

        $conexao = mysqli_connect("localhost", "root", "","banco_tintas") or die ("Falha na conexão");

        if(isset($_POST["identificacao"])) {
            $identificacao = $_POST["identificacao"];
        }

        $tabela = mysqli_query($conexao, "CALL tintas_carregarPor_identificacao('$identificacao')");

        $dataVencimento1;
        $marca1;
        $imagem;
        $cor1;
        $dataRecebimento1;
        $volume1;

        while ($linha = mysqli_fetch_array($tabela)) {
            $dataVencimento1 = $linha['dataValidade'];
            $marca1 = $linha['marca'];
            $imagem = $linha['imagem'];
            $cor1 = $linha['cor'];
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

        $cor = $cor1;

        mysqli_close($conexao);

        date_default_timezone_set('America/Sao_Paulo');
    
        $dataAgora = date('Y-m-d');

        if(strtotime($dataVencimento) < strtotime($dataAgora)) {
            $_SESSION["mensagem-alterar-tinta"] = "A data de validade não pode ser anterior à data de hoje. A tinta está vencida!";
        }
        else if(strtotime($dataRecebimento) > strtotime($dataAgora)) {
            $_SESSION["mensagem-alterar-tinta"] = "A data de recebimento não pode estar no futuro. Informe a data de hoje ou anterior a ela!";
        }
        else {
            $conexao = mysqli_connect("localhost", "root", "","banco_tintas") or die ("Falha na conexão");

            mysqli_query($conexao, "CALL tintas_atualizar('$identificacao', '$dataVencimento', '$marca', '$imagem', $volume, '$cor', '$dataRecebimento')");

            mysqli_close($conexao);

            $_SESSION["mensagem-alterar-tinta"] = "Tinta alterada.";
        }
    }
?>