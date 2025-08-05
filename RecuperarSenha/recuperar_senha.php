<?php
    session_start();

    if(isset($_SESSION["mensagem"])) {
        $mensagem = $_SESSION["mensagem"];

        unset($_SESSION["mensagem"]);
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
    <link rel="stylesheet" href="recuperar-senha.css">

    <!-- FontAwesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" rel="stylesheet">
    <!-- Javascritp -->
    <script src="./js/scripts.js"></script>

    <link rel="shortcut icon" href="../imagens/Logo.png" type="image/x-icon">
    <title>Banco de Tintas | Recuperar Senha</title>
</head>

<body>
    <div class="container">
        <div class="content first-content">
            <div class="first-column">
                <h2 class="title title-primary">Olá, esquecidinho(a)!</h2>
                <p class="description description-primary">Informe o e-mail cadastrado</p>
                <p class="description description-primary">e bora recuperar essa senha</p>
            </div>
            <div class="second-column">
                <h2 class="title title-second">Recuperar senha</h2>
                <div class="form-sign-in">
                    <form action="../php/usuarios_config.php" method="POST">
                        <input type="hidden" name="gerar-codigo-alterar-senha">
                        <label class="label-input" for="">
                            <i class="fa-solid fa-envelope icon-modify"></i>
                            <input class="input-text" type="email" id="floatingInput" placeholder="seu-email@gmail.com" name="email" required>
                        </label>
                        <button class="btn btn-primary" type="submit">Enviar código</button>
                    </form>
                </div>
            </div>
        </div>
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
    </div>
</body>

</html>