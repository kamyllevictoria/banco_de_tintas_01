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

    <!-- CSS -->
    <link rel="stylesheet" href="css/login.css">

    <!-- FontAwesome  -->
    <link rel="stylesheet" href="icones/fontawesome/css/all.min.css">
    
    <link rel="shortcut icon" href="imagens/Logo.png" type="image/x-icon">
    <title>Banco de Tintas</title>
    
</head>

<body>
    <div class="container">
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
                    
                    <a class="password" href="RecuperarSenha/recuperar_senha.html">Esqueci minha senha</a>
                    <button class="btn btn-second" type="submit">Entrar</button>
                    <p class="no-account">
                        Não tem uma conta? <a class="signup-link" href="cadastro.php">Cadastre-se</a>
                    </p>
                    
                </form>
                </div>
                
            </div> <!--final second-column-->
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
        </div> <!--final first-content-->   
    </div> <!--final container-->
    <script src="./js/scripts.js"></script>
</body>

</html>