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

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>

    <!-- CSS -->
    <link rel="stylesheet" href="css/login.css">

    <!-- FontAwesome  -->
    <link rel="stylesheet" href="icones/fontawesome/css/all.min.css">
    
    <link rel="shortcut icon" href="imagens/Logo.png" type="image/x-icon">
    <title>Banco de Tintas</title>
    
</head>

<body>
    <div class="container-fluid" id="containerLogin">
        <div class="content first-content">
            <div class="first-column">
                <h2 class="title title-primary">Olá, pintor!</h2>
                <p class="description description-primary">por favor entre com seus dados pessoais</p>
                <p class="description description-primary">e comece a sua jornada com a gente</p>
                <a href="cadastro.php"><button class="btn btn-primary">Cadastrar</button></a>
                
            </div> <!--final first-column-->
            <div class="second-column">
                <h2 class="title title-second">Faça seu login</h2>
                <div class="social-media">
                    <ul class="list-social-media">
                        <a class="link-social-media" href="#">
                            <li class="item-social-media"><i class="fa-brands fa-facebook-f"></i></li>
                        </a>
                        <a class="link-social-media" href="#">
                            <li class="item-social-media"><i class="fa-brands fa-google"></i></li>
                        </a>
                        <a class="link-social-media" href="#">
                            <li class="item-social-media"><i class="fa-brands fa-linkedin-in"></i></li>
                        </a>
                    </ul>
                    
                </div>
                <p class="description description-second">ou use o seu e-mail</p>
                <div class="form-sign-in">
                    <form action="php/usuarios_config.php" method="post">
                    <input type="hidden" name="logar-usuario">
                    <label class="label-input" for="">
                        <i class="fa-solid fa-envelope icon-modify"></i>
                        <input class="input-text" type="email" id="floatingInput" placeholder="seu-email@gmail.com" name="email" required>
                    </label>
                    <label class="label-input" for="">
                        <i class="fa-solid fa-lock icon-modify"></i>
                        <input class="input-text" type="password" id="floatingPassword" placeholder="Senha" name="senha" required>
                    </label>
                    
                    <a class="password" href="RecuperarSenha/recuperar_senha.php">Esqueci minha senha</a>
                    <button class="btn btn-second" type="submit">Entrar</button>
                    <p class="no-account">
                        Não tem uma conta? <a class="signup-link" href="cadastro.php">Cadastre-se</a>
                    </p>
                    
                </form>
                </div>
                <?php if($mensagem): ?>
                    <div class="row mt-2">
                        <div class="col-12">
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <?= $mensagem; ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div> <!--final second-column-->
        </div> <!--final first-content-->   
    </div> <!--final container-->
    <script src="./js/scripts.js"></script>
</body>

</html>