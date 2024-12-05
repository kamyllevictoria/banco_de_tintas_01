<?php
    session_start();
    if(!(isset($_SESSION["mensagem-cadastrar-tinta"]))) {
        $_SESSION["mensagem-cadastrar-tinta"] = NULL;
    }

    if(!(isset($_SESSION["USUARIO"]))) {
        $_SESSION["USUARIO"] = NULL;
    }

    if(!(isset($_SESSION["ADM"]))) {
        $_SESSION["ADM"] = NULL;
    }

    if($_SESSION["ADM"] == FALSE && $_SESSION["ADM"] == NULL) {
        header('location: index.php');
    }
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bem vindo | Catálogo de Tintas</title>
    
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- CSS -->
    <link rel="stylesheet" href="./css/main.css">
    <link rel="stylesheet" href="./css/navbarLogado.css">
    <link rel="stylesheet" href="./css/cadastrartinta.css">

    <!-- script -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Javascritp -->
    <script src="./js/scripts.js"></script>

    <!-- FontAwesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" rel="stylesheet">

</head>

<body>
    <header> 
        <nav class="navbar navbar-expand-lg navbar-custom">
            <div class="container">
                <div class="nao-sei d-flex justify-content-between align-items-center w-100">
                    <!-- Logo -->
                    <a class="navbar-brand d-flex align-items-center" href="index.php">
                        <img src="./imagens/Logo.png" alt="Logo">
                        Banco de tintas
                    </a>
                    <!-- Botão do menu lateral -->
                    <button class="navbar-toggler" onclick="toggleMenu()">☰</button>
                </div>

                <!-- Conteúdo da navbar -->
                <div class="navbar-collapse" id="navbarContent">
                    <div class="navbar-center mx-auto">
                        <!-- Logo -->
                        <a class="navbar-brand d-flex align-items-center logo-balde" href="index.php">
                            <img src="./imagens/Logo.png" alt="Logo">
                            Banco de tintas
                        </a>

                        <a href="quero_doar.php" class="link-quero-doar">Quero doar</a>
                        <div class="search-wrapper pesquisar1">
                            <span class="search-icon">
                                <i class="fa fa-search"></i>
                            </span>
                            <form id="form-pesquisa" action="config/tintas_config.php" method="POST">
                                <input type="hidden" name="busca" value="1">
                                <input id="Pesquisa" class="form-control form-control-custom" type="search" placeholder="Buscar" aria-label="Buscar" name="pesquisa">
                            </form>
                        </div>

                        <a class="ola">Olá, Fatec!</a>

                        <!-- Dropdown com foto de perfil -->
                        <div class="navbar-end dropdown">
                            <a href="#" class="d-flex align-items-center" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                <img src="./imagens/UsuarioVerde.png" alt="Foto de perfil">
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item text-start" href="catalogo.php">Administrativo</a></li>
                                <li><a class="dropdown-item text-start" href="#">
                                    <form action="config/usuarios_config.php" method="post">
                                        <input type="hidden" name="logout-usuario">
                                        <button type="submit" class="btn btn-danger">Sair</button>
                                    </form>
                                </a></li>

                            </ul>
                        </div>
                    </div>

                    <div class="search-wrapper pesquisar2">
                        <span class="search-icon">
                            <i class="fa fa-search"></i>
                        </span>
                        <form id="form-pesquisa" action="config/tintas_config.php" method="POST">
                            <input type="hidden" name="busca" value="1">
                            <input id="Pesquisa" class="form-control form-control-custom" type="search" placeholder="Buscar" aria-label="Buscar" name="pesquisa">
                        </form>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Menu lateral -->
        <div class="side-menu" id="sideMenu">
            <h2>Banco de Tintas</h2>
            <br>
            <a class="d-flex align-items-center" href="#">
                <img src="./imagens/UsuarioVerde.png" alt="Foto de perfil" class="foto-perfil">
            </a>
            <br>
            <a href="quero_doar.php">Quero doar</a>
            <a href="catalogo.php">Administrativo</a>
            <form action="config/usuarios_config.php" method="post">
                <input type="hidden" name="logout-usuario">
                <button type="submit" class="btn btn-danger">Sair</button>
            </form>
        </div>
        <div class="menu-overlay" id="menuOverlay" onclick="toggleMenu()"></div>
    </header>

    <section class="pagina">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-2 pb-3 col-12 sidebar">
                    <h4 class="menu_text">MENU</h4>
                    <ul class="nav flex-column">
                        <li class="nav-item pad_top_20">
                            <a class="nav-link text-dark link_bg_adm" href="pedidos.php">Pedidos a serem aprovados</a>
                        </li>
                        <li class="nav-item pad_top_20">
                            <a class="nav-link text-dark link_bg_adm" href="cadastrar_tinta.php">Cadastrar tinta</a>
                        </li>

                        <li class="nav-item pad_top_20">
                            <a class="nav-link text-dark link_bg_adm" href="catalogo.php">Catálogo</a>
                        </li>
                    </ul>
                </div>

                <div class="col-lg-10 col-12 main-content">
                    <div class="container">
                        <?php
                            $mensagem = $_SESSION["mensagem-cadastrar-tinta"];

                            if($mensagem != NULL) {
                                echo '<div class="row mt-2">';
                                echo '<div class="col-12">';

                                if($mensagem == "Tinta cadastrada.") {
                                    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">';
                                    echo '<strong>Sucesso!</strong>';
                                }
                                else {
                                    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">';
                                    echo '<strong>Cadastro inválido!</strong>';
                                }
                                echo ' '.$mensagem;
                                echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
                                echo '</div>';
                                echo '</div>';
                                echo '</div>';

                                $_SESSION["mensagem-cadastrar-tinta"] = NULL;
                            }
                        ?>
                        <div class="row">
                            <div class="col-lg-12">

                                <div class="row justify-content-center">
                                    <div class="col-xl-10 col-lg-12">
                                        <form action="config/tintas_config.php" method="post"
                                            enctype="multipart/form-data">
                                            <input type="hidden" name="cadastrar-tinta">
                                            <h4 class="text_green_2 ">CADASTRAR TINTA</h4>
                                            <div class="row bg_lilac">

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="nomeTinta"
                                                            class="text_black pad_top_bt_5">Identificação:</label>
                                                        <input type="text" class="form-control" id="nomeTinta"
                                                            placeholder="Ex.: 01 ou A ou 1A..." name="identificacao"
                                                            required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="corTinta"
                                                            class="text_black pad_top_bt_5">Cor:</label>
                                                        <input type="text" class="form-control" id="corTinta"
                                                            placeholder="Cor" name="cor" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="marcaTinta"
                                                            class="text_black pad_top_bt_5">Marca:</label>
                                                        <input type="text" class="form-control" id="marcaTinta"
                                                            placeholder="Marca" name="marca">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="dataVencimento" class="text_black pad_top_bt_5">Data
                                                            de Vencimento:</label>
                                                        <input type="date" class="form-control" id="DataVencimento"
                                                            placeholder="12/05/2024" name="dataVencimento" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="quantidadeLatas"
                                                            class="text_black pad_top_bt_5">Data de recebimento</label>
                                                        <input type="date" class="form-control" id="DataRecebimento"
                                                            placeholder="12/05/2024" name="dataRecebimento" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="volumeLitros" class="text_black pad_top_bt_5">Volume
                                                            em Litros: </label>
                                                        <input type="number" step=".01" class="form-control"
                                                            id="volumeLitros" placeholder="Volume em litro"
                                                            name="volume" required>
                                                    </div>
                                                    <div class="form-group">

                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="uploadImagem" class="text_black pad_top_bt_5">Upload
                                                            da Imagem:</label>
                                                        <div class="border p-1 d-flex flex-column justify-content-center align-items-center"
                                                            style="height: 90px; background-color: #f9f9f9; border-radius: 5px;">
                                                            <span class="text_black">Arraste e solte o arquivo JPEG ou
                                                                PNG aqui</span>
                                                            <button type="button" class="btn btn-green mt-1"
                                                                onclick="document.getElementById('uploadImagem').click();">
                                                                Selecionar arquivo
                                                            </button>
                                                            <input type="file" class="form-control-file"
                                                                id="uploadImagem" name="imagem"
                                                                style="opacity: 0; position:absolute;" required>
                                                        </div>
                                                    </div>

                                                    <div class="mt-2">
                                                        <img alt=""
                                                            id="img-tintas">
                                                    </div>
                                                </div>

                                                <div class="text-center mt-4">
                                                    <button type="submit" class="btn btn-green col-8">Cadastrar</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
        let imagem = document.getElementById("img-tintas");
        let botaoImagem = document.getElementById("uploadImagem");

        botaoImagem.addEventListener('change', () => {

            if (botaoImagem.files.lenght <= 0) {
                return;
            }

            let leitor = new FileReader();

            leitor.onload = () => {
                imagem.src = leitor.result;
            }

            console.log(imagem.src);

            leitor.readAsDataURL(botaoImagem.files[0]);
        });
    </script>
</body>

</html>