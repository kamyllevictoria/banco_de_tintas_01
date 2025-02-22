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
    <link rel="stylesheet" href="css/login copy.css">
    <link rel="stylesheet" href="css/navbarDeslog.css">
    
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
    
    <!-- FontAwesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" rel="stylesheet">

    <title>Banco de Tintas</title>

    <style>

        body {
            background-color: #8eb041;
        }

        body.high-contrast {
            background-color: black;
        }

        /* Estilo de alto contraste */

        body.high-contrast .btn-primary, 
        .btn-primary {
        background-color: white;
        color: black;
        }

        body.high-contrast .btn-cancelar {
        border-color: white;
        }
        body.high-contrast a .esqueci-senha {
        color: cyan;
        }

        body.high-contrast .cadastrar {
        color: cyan;
        }
        body.high-contrast .btn:hover {
        background-color: cyan;
        }

        body.high-contrast .form-check-label{
        color: white;
        }

        /* Gerais */
        body,
        html {
        height: 100%;
        margin: 0;
        padding: 0;
        font-family: "Roboto" sans-serif;
        background-color: #8eb041;
        }

        .login{
        overflow: hidden;
        }
        .recuperar-senha{
        overflow: hidden;
        }
        .img-col {
        height: 100vh;
        }
        .form-floating {
        padding-bottom: 10px;
        }
        .img-fluid {
        object-fit: cover;
        height: 100%;
        width: 100%;
        }


        .btn-primary {
            background-color: #84469b;
            border: none;
            border-radius: 9px;
            height: 48px;
            font-size: 24px;
            color: white;
        }

        .btn:hover {
        background-color: darkslateblue;
        }
        .btn-cancelar{
        border-color: #84469b;
        border-style: double;
        background: none;
        border-radius: 9px;
        height: 48px;
        font-size: 24px;
        }
        .esqueci-senha {
        text-align: center;
        padding-top: 10px;
        color: #84469b;
        }
        .esqueci-senha:hover {
        color: darkslateblue;
        }

        .cadastrar {
        color: #84469b;
        font-weight: 700;
        padding-bottom: 10px;
        }

        .radio-container {
        display: flex;
        align-items: center;
        gap: 20px;
        }

        .form-label {
        color: #fff;
        }
        .container-fluid {
        padding: 0;
        }
        .listaSuspensa{
        height: 30px;
        background-color: #ffffff;
        border: none;
        border-radius: 9px;
        width: 60%;
        }
        .dropdown-toggle::after {
        position: absolute;
        right: 240px;
        top: 50%;
        transform: translateY(-50%);
        margin-left: auto;
        }

        .dropdown-toggle {
        padding-right: 2rem;
        text-align: left;
        }
        .dropdown-item:hover{
        background-color: #e4e4e4;
        }


        /* Navbar */
        header,
        .navbar {
        background-color: #ffff;
        }
        .navbar-custom {
        background-color: #ffffff;
        box-shadow: 0px 2px 10px rgba(0, 0, 0, 0.5);
        padding: 20px 0;
        z-index: 1000;
        }

        .navbar-brand {
        font-size: 1.4rem;
        font-weight: bold;
        color: #8eb041;
        }
        .navbar-brand img {
        max-height: 50px;
        margin-right: 8px;
        }
        .navbar-brand:hover {
        color: #637046;
        }



        @media (max-width: 766px) {
        .div-img {
            display: none;
        }
        .container-fluid {
            padding-top: 130px;
            width: 350px;
        }
        .dropdown-toggle::after {
            right: 180px;
        }
        }
        @media (min-width: 767px) and (max-width: 1077px) {
        .bt-senha {
            height: 80px;
        }
        .dropdown-toggle::after {
            right: 40px;
        }
        .listaSuspensa{
            width: 90%;
        }
        }
        @media (min-width: 767px) and (max-width: 1077px) {
        .bt-senha {
            height: 80px;
        }
        .dropdown-toggle::after {
            right: 40px;
        }
        .listaSuspensa{
            width: 90%;
        }
        }
        @media (min-width: 768px) and (max-width: 916px) {
        .btn-secondary{
            font-size: 18px
        }
        }
        @media (min-width: 1078px){
        .dropdown-toggle::after {
            right: 30px;
        }
        .listaSuspensa{
            width: 95%;
        }
        }

    </style>
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
                    <form action="config/usuarios_config.php" method="post">
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