<?php
    session_start();

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
    <link rel="stylesheet" href="css/cadastro-login.css">
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
        
    <!-- Java Script -->
    <script src="js/scripts.js" defer></script>

    <link rel="shortcut icon" href="imagens/Logo.png" type="image/x-icon">

    <title>Banco de Tintas</title>
</head>

<body class="cadastro">
    <header>
        <div class="container" id="nav-container">
            <nav class="navbar navbar-expand-lg fixed-top shadow">
                <a href="index.php" class="navbar-brand">
                    <img id="logo" src="imagens/Logo.png" alt="Banco de Tintas"> Banco de Tintas
                </a>
                
            </nav>
        </div>
    </header>

    <div class="container-fluid">
        <div class="row">

            <!-- Coluna com formulario -->
            <div class="col-12 col-lg-4 col-sm- 12 d-flex justify-content-center fundo_login">
                <main class="form-container p-xl-5 p-lg-4 p-md-5 mt-md-5 mb-5 mb-md-0">
                    <div id="container-formulario">
                        <form action="config/usuarios_config.php" method="post">
                            <input type="hidden" name="cadastrar-usuario">
                            <h1 class="h3 fw-bold text-light py-4">Cadastro</h1>

                            <!-- Nome -->
                            <div id="nomePessoa" class="mb-xxl-3 mb-2">
                                <label for="formInput" class="form-label">Nome</label>
                                <input type="text" class="form-control" id="nome" name="Nome">
                            </div>
                            <!-- Nome Empresa-->
                            <div id="nomeEmpresa" class="mb-xxl-3 mb-2" style="display: none;">
                                <label for="formInput" class="form-label">Nome da empresa</label>
                                <input type="text" class="form-control" id="nome" name="empresa">
                            </div>

                            <!-- e-mail -->
                            <div class="mb-xxl-3 mb-2">
                                <label for="formInput" class="form-label">E-mail</label>
                                <input type="email" class="form-control" id="Email" placeholder="seu-email@gmail.com" required name="email">
                            </div>

                            <!-- Pessoa fisica ou juridica -->
                            <div class="radio-container">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" id="p_fisica" name="tipoPessoa" value="fisica" onclick="cpfOuCnpj()" checked>
                                    <label class="form-check-label" for="p_fisica">
                                        Pessoa física
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" id="p_juridica" name="tipoPessoa" value="juridica" onclick="cpfOuCnpj()">
                                    <label class="form-check-label" for="p_juridica">
                                        Pessoa juridica
                                    </label>
                                </div>  
                            </div>

                            <!-- CPF -->
                            <div id="campoCPF" class="mb-xxl-3 mb-2">
                                <label for="formInput" class="form-label">CPF</label>
                                <input type="number" class="form-control" id="CPF" placeholder="Apenas números. 11 dígitos." name="cpf">
                            </div>
                            <!-- CNPJ -->
                            <div id="campoCNPJ" class="mb-xxl-3 mb-2" style="display: none;">
                                <label for="formInput" class="form-label">CNPJ</label>
                                <input type="number" class="form-control" id="CNPJ" placeholder="Apenas números. 14 dígitos" name="cnpj">
                            </div>
                            
                            <!-- Telefone -->
                            <div class="mb-xxl-3 mb-2">
                                <label for="formInput" class="form-label">Telefone</label>
                                <input type="number" class="form-control" id="Telefone" placeholder="Apenas números. 8 ou 11 dígitos." required name="telefone">
                            </div>

                            <!-- Senha -->
                            <div class="mb-xxl-3 mb-2">
                                <label for="formInput" class="form-label">Senha</label>
                                <input type="password" class="form-control" id="Senha" placeholder="No mínimo 6, no máximo 8 caracteres." required name="senha">
                            </div>
                            <!-- Como conheceu? -->

                            <div class="mb-xxl-3 mb-2">
                                <label for="formInput" class="form-label">Como você conheceu o Banco de Tintas?</label>
                                <select name="direcionamento" id="Direcionamento">
                                    <option value="1">Fatec</option>
                                    <option value="2">Instagram</option>
                                    <option value="3">Linkedin</option>
                                    <option value="4">Pesquisa Google</option>
                                </select>
                            </div>

                            <label class="cadastrar">Já possui cadastro?</label>
                            <a class="text-light" href="./login.php">Entrar</a>

                            <button type="submit" class="btn btn-primary w-100">Cadastrar</button>
                            
                        </form>
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
                </main>
            </div>
        </div>
    </div>
</body>
</html>