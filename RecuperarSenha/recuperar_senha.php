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
    <link rel="stylesheet" href="recuperar-senha.css">

    <!-- FontAwesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" rel="stylesheet">
    <!-- Javascritp -->
    <script src="./js/scripts.js"></script>

    <link rel="shortcut icon" href="../imagens/Logo.png" type="image/x-icon">
    <title>Banco de Tintas | Recuperar Senha</title>
</head>

<body>
    <div class="container-fluid" id="containerID">
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
                <div class="container">
                    <?php if($mensagem): ?>
                        <div class="row mt-2">
                            <div class="col-12">
                                <div class="alert <?php if($mensagem[0]) {echo "alert-success";}else{echo "alert-danger";}?> alert-dismissible fade show" role="alert">
                                    <?= $mensagem[1]; ?>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</body>

</html>