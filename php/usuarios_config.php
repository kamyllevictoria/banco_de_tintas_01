<?php

    require 'phpBD/conexaoBD.php';
    require 'phpBD/usuariosBD.php';
    require 'phpBD/utilitarios.php';

    if(isset($_POST["cadastrar-usuario"])) {
        session_start();

        $Nome = $_POST["Nome"];
        $empresa = $_POST["empresa"];
        $email = $_POST["email"];
        $cpf = $_POST["cpf"];
        $cnpj = $_POST["cnpj"];
        $telefone = $_POST["telefone"];
        $direcionamento = $_POST["direcionamento"];
        $senha = $_POST["senha"];
        $foto = NULL;
        
        $senhaHash = password_hash($senha, PASSWORD_DEFAULT);

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
                $tabela = clientes_carregarPor_email($mysqli, $email);
                $qtd_linhas = $tabela -> num_rows;
                $mysqli -> next_result();
        
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
                            $tabela = clientes_carregarPor_cnpj($mysqli, $cnpj);
                            $qtd_linhas = $tabela -> num_rows;
                            $mysqli -> next_result();
            
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
                                        $tipoPessoa = 2;

                                        clientes_adicionar($mysqli, $email, $foto, $telefone, $senhaHash, $empresa, $direcionamento, $tipoPessoa, $cpf, $cnpj);
                                        $mysqli -> next_result();

                                        header("Location: ../login.php");
                                    }
                                }
                            }
                        }
                    }
                    else{
                        $tabela = clientes_carregarPor_cpf($mysqli, $cpf);
                        $qtd_linhas = $tabela -> num_rows;
                        $mysqli -> next_result();
            
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
                                    $tipoPessoa = 1;

                                    clientes_adicionar($mysqli, $email, $foto, $telefone, $senhaHash, $Nome, $direcionamento, $tipoPessoa, $cpf, $cnpj);
                                    $mysqli -> next_result();
                                    
                                    header("Location: ../login.php");
                                }
                            }
                        }
                    }
                }
            }
        }
    }

    if(isset($_POST["logar-usuario"])) {
       session_start();

        if($_POST["email"] != NULL && $_POST["senha"] != NULL) {
            $email = $_POST["email"];
            $senha = $_POST["senha"];
    
            $tabela = clientes_carregarPor_email($mysqli, $email);
            $linha2 = $tabela -> fetch_assoc();
            $qtd_linhas = $tabela -> num_rows;
            $mysqli -> next_result();
    
            if($qtd_linhas <= 0){
                $tabela = gestor_carregarPor_email($mysqli, $email);
                $linha = $tabela -> fetch_assoc();
                $qtd_linhas = $tabela -> num_rows;
    
                if($qtd_linhas > 0){

                    if(password_verify($senha, $linha["senhaHash"])){
    
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
    
                if(password_verify($senha, $linha2["senhaHash"])){
    
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

    if(isset($_POST["logout-usuario"])) {
        session_start();

        $_SESSION["USUARIO"] = FALSE;
        $_SESSION["ADM"] = FALSE;

        header("Location: ../index.php");
    }

    if(isset($_POST["alterar-usuario"])) {
        session_start();
        
        $nome = $_POST["nome"];
        $email = $_POST["email"];
        $telefone = $_POST["telefone"];
        $imagem = $_FILES['foto'];

        if($imagem['name'] != "") {
            $foto = gravarImagem($imagem);
        }
        else {
           $foto = "";
        }

        $id = $_SESSION["USUARIO"];

        $tabela = clientes_carregarPor_email($mysqli, $email);
        $linha = $tabela -> fetch_assoc();
        $qtd_linhas = $tabela -> num_rows;
        $mysqli -> next_result();

        if($qtd_linhas > 0) {
            $_SESSION["cadastro-login"] = "Este e-mail já está em uso. Informe um e-mail diferente!";
        }
        else {
            $tabela = clientes_carregarPor_id($mysqli, $id);
            $linha = $tabela -> fetch_assoc();
            $mysqli -> next_result();

            $senhaHash = $linha["senhaHash"];
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
                removerImagem($linha["foto"]);
            }

            clientes_atualizar($mysqli, $id, $email, $foto, $telefone, $senhaHash, $nome, $direcionamento);
            $mysqli -> next_result();

            $_SESSION["cadastro-login"] = "Dados atualizados.";
        }

        header("Location: ../usuario.php");
    }

    if(isset($_POST["remover-foto"])) {
        session_start();

        $id = $_SESSION["USUARIO"];

        $tabela = clientes_carregarPor_id($mysqli, $id);
        $linha = $tabela -> fetch_assoc();
        $mysqli -> next_result();

        if($linha["foto"] != NULL) {
            removerImagem($linha["foto"]);

            $foto = "";
            $email = $linha["email"];
            $telefone = $linha["telefone"];
            $senhaHash = $linha["senhaHash"];
            $nome = $linha["nome"];
            $direcionamento = $linha["direcionamento"];
    
            clientes_atualizar($mysqli, $id, $email, $foto, $telefone, $senhaHash, $nome, $direcionamento);
            $mysqli -> next_result();
    
            $_SESSION["cadastro-login"] = "Foto removida.";
        }

        header("Location: ../usuario.php");
    }

    if(isset($_POST["remover-conta"])) {
        
    }

    //TODO: KLEBER - fazer if(isset($_POST["alterar-senha"])) {
?>