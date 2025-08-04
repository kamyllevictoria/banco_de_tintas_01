<?php
    session_start();
    if(!(isset($_SESSION["cadastro-login"]))) {
        $_SESSION["cadastro-login"] = NULL;
    }

    if(isset($_SESSION["cadastro-login"])) {
        $mensagem = $_SESSION["cadastro-login"];

        unset($_SESSION["cadastro-login"]);
    }
    else {
        $mensagem = null;
    }
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- fonte -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;700&display=swap" rel="stylesheet">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- CSS -->
    <link rel="stylesheet" href="css/login.css">
    <link rel="stylesheet" href="css/navbarDeslog.css">

    <!-- FontAwesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" rel="stylesheet">
    
    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>

    <!-- Javascritp -->
    <script src="./js/scripts.js"></script>
    
    <link rel="shortcut icon" href="imagens/Logo.png" type="image/x-icon">

    <title>Banco de Tintas</title>
</head>

<body class="login">
    <header >
        <div class="container" id="nav-container">
            <nav class="navbar navbar-expand-lg fixed-top shadow">
                <a href="index.php" class="navbar-brand">
                    <img id="logo" src="imagens/Logo.png" alt="Banco de Tintas"> Banco de Tintas
                </a>
            </nav>
        </div>
    </header>


    <script src=" js/scripts.js"></script>
    <div class="container-fluid">
        <div class="row">

            <div class="col-12 col-md-3 d-flex align-items-center div-vazia"></div>

            <div class="col-12 col-md-3 d-flex align-items-center fundo_login">
                <main class=" w-100 m-auto form-container">
                    <form action="php/usuarios_config.php?acao=logar-usuario" method="post">
                        <input type="hidden" name="logar-usuario">
                        <h1 class="h3 mb-3 fw-bold text-light py-4">Login</h1>
                        <div class="form-floating">
                            <input type="email" class="form-control" id="floatingInput" placeholder="seu-email@gmail.com" name="email" />
                            <label for="floatingInput">E-mail</label>
                        </div>
                        <div class="form-floating">
                            <input type="password" class="form-control" id="floatingPassword" placeholder="Senha" name="senha" />
                            <label for="floatingPassword">Senha</label>
                        </div>
                        <label class="cadastrar">Não possui cadastro?</label>
                        <a class="text-light py-5" href="cadastro.php">Cadastre-se</a>

                        <button type="submit" class="btn btn-primary w-100">Entrar</button>
                        <div class="text-center py-4">
                            <a href="RecuperarSenha/recuperar_senha.html" class="text-light esqueci-senha">Esqueci minha senha</a>
                        </div>
                        
                    </form>
                    <?php if($mensagem): ?>
                        <div class="row mt-2">
                            <div class="col-12">
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <strong>Dados inválidos!</strong>
                                    <?= $mensagem; ?>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                </main>
            </div>

            <!-- Coluna da direita com a imagem -->
            <div class="col-12 col-md-6 img-col p-0 div-img">
                <img src="imagens/Tintas_Pinceis.png" class="img-fluid" alt="Imagem">
            </div>
        </div>
    </div>

</body>

</html>