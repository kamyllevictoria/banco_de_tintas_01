<?php

    if(isset($_POST["cadastrar-usuario"])) {
        cadastrarUsuario();
    }

    if(isset($_POST["logar-usuario"])) {
        logarUsuario();
    }

    if(isset($_POST["logout-usuario"])) {
        logout();
        header("Location: ../index.php");
    }

    if(isset($_POST["alterar-usuario"])) {
        alterarUsuario();

        header("Location: ../usuario.php");
    }

    if(isset($_POST["remover-foto"])) {
        removerFoto();

        header("Location: ../usuario.php");
    }

    function cadastrarUsuario() {
        session_start();

        if(isset($_POST["Nome"])) {
            $Nome = $_POST["Nome"];
        }

        if(isset($_POST["empresa"])) {
            $empresa = $_POST["empresa"];
        }

        if(isset($_POST["email"])) {
            $email = $_POST["email"];
        }

        if(isset($_POST["cpf"])) {
                $cpf = $_POST["cpf"];
            }

        if(isset($_POST["cnpj"])) {
            $cnpj = $_POST["cnpj"];
        }

        if(isset($_POST["telefone"])) {
            $telefone = $_POST["telefone"];
        }

        if(isset($_POST["senha"])) {
            $senha = $_POST["senha"];
        }

        if(isset($_POST["direcionamento"])) {
            $direcionamento = $_POST["direcionamento"];

            switch($direcionamento) {
                case "1":   
                    $direcionamento = "Fatec";
                break;

                case "2":
                    $direcionamento = "Instagram";
                break;

                case "3":
                    $direcionamento = "Linkedin";
                break;

                case "4":
                    $direcionamento = "Pesquisa Google";
                break;
            }
        }
        $foto = NULL;

        if(strlen($telefone) != 8 && strlen($telefone) != 11) {
            $_SESSION["cadastro-login"] = "Digite um telefone válido de 8 ou 11 dígitos!";
            header("Location: ../cadastro.php");
        }
        else {

            if($Nome == NULL && $empresa == NULL) {
                $_SESSION["cadastro-login"] = "Informe um nome ou um nome da empresa!";
                header("Location: ../cadastro.php");
            }
            else {
                $conexao = mysqli_connect("localhost", "root", "","banco_tintas") or die ("Falha na conexão");
                $tabela = mysqli_query($conexao, "CALL clientes_carregarPor_email('$email')");
                $qtd_linhas = mysqli_num_rows($tabela);
                mysqli_close($conexao);
        
                if($qtd_linhas > 0) {
                    $_SESSION["cadastro-login"] = "Este e-mail já está cadastrado!";
                    header("Location: ../cadastro.php");
                }
                else {
                    if ($cpf == NULL){
                        
                        if ($cnpj == NULL){
                            $_SESSION["cadastro-login"] = "Informe um CPF ou CNPJ!";
                            header("Location: ../cadastro.php");
                        }
                        else{
                            $conexao = mysqli_connect("localhost", "root", "","banco_tintas") or die ("Falha na conexão");
                            $tabela = mysqli_query($conexao, "CALL pessoasJuridicas_carregarPor_cnpj('$cnpj')");
                            $qtd_linhas = mysqli_num_rows($tabela);
                            mysqli_close($conexao);
            
                            if($qtd_linhas > 0) {
                                $_SESSION["cadastro-login"] = "Este CNPJ já está cadastrado!";
                                header("Location: ../cadastro.php");
                            }
                            else {
    
                                if (strlen($cnpj) != 14){
                                    $_SESSION["cadastro-login"] = "Quantidade inválida de dígitos para o CNPJ. Informe um CNPJ válido!";
                                    header("Location: ../cadastro.php");
                                }
                                else {
                                    if(strlen($senha) < 6 || strlen($senha) > 8) {
                                        $_SESSION["cadastro-login"] = "A senha cadastrada deve conter no mínimo 6 e no máximo 8 caracteres!";
                                        header("Location: ../cadastro.php");
                                    }
                                    else {
                                        $conexao = mysqli_connect("localhost", "root", "","banco_tintas") or die ("Falha na conexão");
            
                                        mysqli_query($conexao, "CALL clientes_adicionar('$email', '$foto', '$telefone', '$senha', '$empresa', '$direcionamento')");
                                        mysqli_close($conexao);
                        
                                        $conexao = mysqli_connect("localhost", "root", "","banco_tintas") or die ("Falha na conexão");
                                        $tabela = mysqli_query($conexao, "CALL clientes_carregarPor_email('$email')");
                                        $linha = mysqli_fetch_array($tabela);
                                        $clienteId = $linha["id"];
                                        mysqli_close($conexao);
                        
                                        $conexao = mysqli_connect("localhost", "root", "","banco_tintas") or die ("Falha na conexão");
                                        mysqli_query($conexao, "CALL pessoasJuridicas_adicionar('$cnpj', $clienteId)");
                                        mysqli_close($conexao);
                
                                        header("Location: ../login.php");
                                    }
                                }
                            }
                        }
                    }
                    else{
                        $conexao = mysqli_connect("localhost", "root", "","banco_tintas") or die ("Falha na conexão");
                        $tabela = mysqli_query($conexao, "CALL pessoasFisicas_carregarPor_cpf('$cpf')");
                        $qtd_linhas = mysqli_num_rows($tabela);
                        mysqli_close($conexao);
            
                        if($qtd_linhas > 0) {
                            $_SESSION["cadastro-login"] = "Este CPF já está cadastrado!";
                            header("Location: ../cadastro.php");
                        }
                        else {
    
                            if (strlen($cpf) != 11){
                                $_SESSION["cadastro-login"] = "Quantidade inválida de dígitos para o CPF. Informe um CPF válido!";
                                header("Location: ../cadastro.php");
                            }
                            else {
                                if(strlen($senha) < 6 || strlen($senha) > 8) {
                                    $_SESSION["cadastro-login"] = "A senha cadastrada deve conter no mínimo 6 e no máximo 8 caracteres!";
                                    header("Location: ../cadastro.php");
                                }
                                else {
                                    $conexao = mysqli_connect("localhost", "root", "","banco_tintas") or die ("Falha na conexão");
            
                                    mysqli_query($conexao, "CALL clientes_adicionar('$email', '$foto', '$telefone', '$senha', '$Nome', '$direcionamento')");
                                    mysqli_close($conexao);
                                    
                                    $conexao = mysqli_connect("localhost", "root", "","banco_tintas") or die ("Falha na conexão");
                                    $tabela = mysqli_query($conexao, "CALL clientes_carregarPor_email('$email')");
                                    $linha = mysqli_fetch_array($tabela);
                                    $clienteId = $linha["id"];
                                    mysqli_close($conexao);
                                    
                                    $conexao = mysqli_connect("localhost", "root", "","banco_tintas") or die ("Falha na conexão");
                                    mysqli_query($conexao, "CALL pessoasFisicas_adicionar('$cpf', $clienteId)");
                                    mysqli_close($conexao);
                
                                    header("Location: ../login.php");
                                }
                            }
                        }
                    }
                }
            }
        }
    }
    
    function logarUsuario() {

        session_start();

        if($_POST["email"] != NULL && $_POST["senha"] != NULL) {
            if(isset($_POST["email"])) {
                $email = $_POST["email"];
            }
    
            if(isset($_POST["senha"])) {
                $senha = $_POST["senha"];
            }
    
            $conexao = mysqli_connect("localhost", "root", "","banco_tintas") or die ("Falha na conexão");
            $tabela = mysqli_query($conexao, "CALL clientes_carregarPor_email('$email')");
            $linha2 = mysqli_fetch_array($tabela);
            mysqli_close($conexao);
            $qtd_linhas = mysqli_num_rows($tabela);

    
            if($qtd_linhas <= 0){
                $conexao = mysqli_connect("localhost", "root", "","banco_tintas") or die ("Falha na conexão");
                $tabela = mysqli_query($conexao, "CALL gestor_carregarPor_email('$email')");
                $linha = mysqli_fetch_array($tabela);
                $qtd_linhas = mysqli_num_rows($tabela);


    
                if($qtd_linhas > 0){
    
                    if($linha["senha"] == $senha){
    
                        $_SESSION["USUARIO"] = FALSE;
                        $_SESSION["ADM"] = $linha["id"];
                        header("Location: ../catalogo.php");
                    }
                    else{
                        $_SESSION["cadastro-login"] = "E-mail ou senha incorretos!";
                        header("Location: ../login.php");
                    }
                }
                else {
                    $_SESSION["cadastro-login"] = "E-mail ou senha incorretos!";
                    header("Location: ../login.php");
                }
            }
            else{
    
                $Email = $linha2["email"];
                $Senha = $linha2["senha"];
                if($Senha == $senha){
    
                    $_SESSION["USUARIO"] = $linha2["id"];
                    $_SESSION["ADM"] = FALSE;
                    header("Location: ../index.php");
                }
                else{
                    $_SESSION["cadastro-login"] = "E-mail ou senha incorretos!";
                    header("Location: ../login.php");
                }
            }
        }
        else {
            $_SESSION["cadastro-login"] = "Preencha todos os campos para efetuar login!";
            header("Location: ../login.php");
        }
    }

    function logout() {
        session_start();
        $_SESSION["USUARIO"] = FALSE;
        $_SESSION["ADM"] = FALSE;
    }

    function alterarUsuario() {
        session_start();
        $caminho = "";

        if(isset($_POST["nome"])) {
            $nome = $_POST["nome"];
        }
        
        if(isset($_POST["email"])) {
            $email = $_POST["email"];
        }

        if(isset($_POST["telefone"])) {
            $telefone = $_POST["telefone"];
        }

        if(isset($_FILES['foto'])) {
            $foto = $_FILES['foto'];

            if($foto['name'] != "") {
                $pasta = "../img-bd/";
                $nomeImagem = $foto['name'];
                $novoNome = uniqid();
                $extensao = strtolower(pathinfo($nomeImagem, PATHINFO_EXTENSION));
    
                move_uploaded_file($foto['tmp_name'], $pasta . $novoNome . "." . $extensao);
    
                $foto = "img-bd/" . $novoNome . "." . $extensao;
            }
            else {
                $foto = "";
            }
        }

        $id = $_SESSION["USUARIO"];

        $conexao = mysqli_connect("localhost", "root", "","banco_tintas") or die ("Falha na conexão");
        $tabela = mysqli_query($conexao, "CALL clientes_carregarPor_email('$email')");
        $linha = mysqli_fetch_array($tabela);
        $qtd_linhas = mysqli_num_rows($tabela);
        mysqli_close($conexao);


        if($qtd_linhas > 0) {
            $_SESSION["cadastro-login"] = "Este e-mail já está em uso. Informe um e-mail diferente!";
        }
        else {
            $conexao = mysqli_connect("localhost", "root", "","banco_tintas") or die ("Falha na conexão");
            $tabela = mysqli_query($conexao, "CALL clientes_carregarPor_id($id)");
            $linha = mysqli_fetch_array($tabela);
            mysqli_close($conexao);

            $senha = $linha["senha"];
            $direcionamento = $linha["direcionamento"];

            if($nome == NULL) {
                $nome = $linha["nome"];
            }

            if($email == NULL) {
                $email = $linha["email"];
            }

            if($telefone == NULL) {
                $telefone = $linha["telefone"];
            }

            if($foto == "") {
                $foto = $linha["foto"];
            }
            else {
                unlink("../".$linha["foto"]);
            }

            $conexao = mysqli_connect("localhost", "root", "","banco_tintas") or die ("Falha na conexão");
            mysqli_query($conexao, "CALL clientes_atualizar($id, '$email', '$foto', '$telefone', '$senha', '$nome', '$direcionamento')");
            mysqli_close($conexao);

            $_SESSION["cadastro-login"] = "Dados atualizados.";
        }
    }

    function removerFoto() {
        session_start();

        $id = $_SESSION["USUARIO"];

        $conexao = mysqli_connect("localhost", "root", "","banco_tintas") or die ("Falha na conexão");
        $tabela = mysqli_query($conexao, "CALL clientes_carregarPor_id($id)");
        $linha = mysqli_fetch_array($tabela);
        mysqli_close($conexao);

        if($linha["foto"] != NULL) {
            unlink("../".$linha["foto"]);

            $foto = "";
            $email = $linha["email"];
            $telefone = $linha["telefone"];
            $senha = $linha["senha"];
            $nome = $linha["nome"];
            $direcionamento = $linha["direcionamento"];
    
            $conexao = mysqli_connect("localhost", "root", "","banco_tintas") or die ("Falha na conexão");
            mysqli_query($conexao, "CALL clientes_atualizar($id, '$email', '$foto', '$telefone', '$senha', '$nome', '$direcionamento')");
            mysqli_close($conexao);
    
            $_SESSION["cadastro-login"] = "Foto removida.";
        }
    }
?>