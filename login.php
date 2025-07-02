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
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" rel="stylesheet">
    
    <link rel="shortcut icon" href="imagens/Logo.png" type="image/x-icon">
    <title>Banco de Tintas</title>
    
</head>

<body>
    <div class="container">
        <div class="content first-content">
            <div class="first-column">
                <h2 class="title title-primary">Bem vindo(a) de volta!</h2>
                <p class="description description-primary">Para se manter conectado conosco</p>
                <p class="description description-primary">por favor entre com seus dados pessoais</p>
                <button id="signin"class="btn btn-primary">Entrar</button>
            </div>
            <div class="second-column">
                <h2 class="title title-second">Criar uma conta</h2>
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
                <p class="description description-second">ou use o seu e-mail para cadastro</p>
                <div class="scroll-box">
                    <form action="config/usuarios_config.php" method="post">
                        <input type="hidden" name="cadastrar-usuario">
                    
                        <label class="label-input" for="">
                            <i class="fa-solid fa-user icon-modify"></i>
                            <input class="input-text" type="text" id="nome" placeholder="Nome" required name="Nome">
                        </label>
        
                        <label class="label-input" for="">
                            <i class="fa-solid fa-envelope icon-modify"></i>
                            <input class="input-text" type="email" id="Email" placeholder="seu-email@gmail.com" required name="email">
                        </label>
                        <!-- Pessoa fisica ou juridica -->
                        <div>
                            <label class="label-text" for="p_fisica">
                                <input type="radio" id="p_fisica" name="tipoPessoa" value="fisica" onclick="cpfOuCnpj()" checked>
                                Pessoa física
                            </label>
                        </div>
                        <div>
                            <label class="label-text" for="p_juridica">
                                <input type="radio" id="p_juridica" name="tipoPessoa" value="juridica" onclick="cpfOuCnpj()">
                                Pessoa juridica
                            </label>
                        </div>
                        <div id="nomeEmpresa" style="display: none;">
                            <label class="label-input" for="" >
                                <i class="fa-solid fa-building icon-modify"></i>
                                <input class="input-text" type="text" id="nomeEmpresa" placeholder="Nome da empresa" name="empresa">
                            </label>
                        </div>

                        <!-- CPF -->
                        <div id="campoCPF">
                            <label class="label-input" for="">
                                <i class="fa-solid fa-id-card icon-modify"></i>
                                <input class="input-text" type="text" id="CPF" placeholder="CPF" name="cpf">
                            </label>
                        </div>
                        <!-- CNPJ -->
                        <div id="campoCNPJ" style="display: none;">
                            <label class="label-input" for="">
                                <i class="fa-solid fa-id-card-clip icon-modify"></i>
                                <input class="input-text" type="text" id="CNPJ" placeholder="CNPJ" name="cnpj">
                            </label>
                        </div>
                        <!-- Telefone -->
                        <label class="label-input" for="">
                            <i class="fa-solid fa-phone icon-modify"></i>
                            <input class="input-text" type="tel" id="Telefone" placeholder="Telefone" pattern="\(\d{2}\)\s9\d{4}-\d{4}" required name="telefone">
                        </label>
                        <!-- Senha -->
                        <label class="label-input" for="">
                            <i class="fa-solid fa-lock icon-modify"></i>
                            <input class="input-text" type="password" id="Senha" placeholder="Senha" required name="senha">
                        </label>
                        <!-- Como conheceu? -->
                        <label class="label-text" for="formInput">Como você conheceu o Banco de Tintas?</label>
                        <select name="direcionamento" id="Direcionamento">
                            <option value="1">Fatec</option>
                            <option value="2">Instagram</option>
                            <option value="3">Linkedin</option>
                            <option value="4">Google</option>
                        </select>
                        <button class="btn btn-primary" type="submit">Cadastrar</button>
                    </form>
                </div>
                
            </div> <!--fim second-column-->
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
        </div> <!--fim first content-->
        <!-- -------------------------------------------------------------------------------------- -->
        <div class="content second-content">
            <div class="first-column">
                <h2 class="title title-primary">Olá, pintor!</h2>
                <p class="description description-primary">por favor entre com seus dados pessoais</p>
                <p class="description description-primary">e comece a sua jornada com a gente</p>
                <button id="signup" class="btn btn-primary">Cadastrar</button>
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
        </div> <!--final second-content-->
    </div> <!--final container-->
    <script src="./js/scripts.js"></script>
</body>

</html>