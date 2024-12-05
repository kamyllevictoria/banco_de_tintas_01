<?php
    session_start();
    if(!(isset($_SESSION["mensagem-alterar-tinta"]))) {
        $_SESSION["mensagem-alterar-tinta"] = NULL;
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
    
    $conexao = mysqli_connect("localhost", "root", "","banco_tintas") or die ("Falha na conexão");
    $tabela = mysqli_query($conexao, "CALL tintas_carregar()");
    mysqli_close($conexao);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bem vindo | Central Banco de Tintas</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- CSS -->
    <link rel="stylesheet" href="./css/main.css">
    <link rel="stylesheet" href="./css/navbarLogado.css">
    <link rel="stylesheet" href="./css/catalogo.css">

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

    <link rel="shortcut icon" href="./icones/balde_tinta.png" type="image/x-icon">

    <style>
        .fechar-modal {
            position: absolute;
            left: 100%;
            top: -10%;
            padding: 10px;
            cursor: pointer;
        }

        .apagar-tinta-mensagem {
            color: white;
            text-align: center;
            font-size: 18px;
        }

        body.high-contrast .text_purple{
            color: white !important;
        }
    </style>

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
                    <?php
                        $mensagem = $_SESSION["mensagem-alterar-tinta"];

                        if($mensagem != NULL) {
                            echo '<div class="row mt-2">';
                            echo '<div class="col-12">';

                            if($mensagem == "Tinta alterada.") {
                                echo '<div class="alert alert-success alert-dismissible fade show" role="alert">';
                                echo '<strong>Sucesso!</strong>';
                            }
                            else {
                                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">';
                                echo '<strong>Dados inválidos!</strong>';
                            }
                            echo ' '.$mensagem;
                            echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
                            echo '</div>';
                            echo '</div>';
                            echo '</div>';

                            $_SESSION["mensagem-alterar-tinta"] = NULL;
                        }
                    ?>
                    <h4 class="text_green_2 text-center text-lg-start">CATALOGO DE TINTAS</h4>
                    <div class="row cards-container">

                        <?php
                        while ($linha = mysqli_fetch_array($tabela)) {
                            $dataValidade = explode('-', $linha["dataValidade"]);
                            $dataRecebimento = explode('-', $linha["dataRecebimento"]);

                            echo '<div class="col-12 col-sm-10 col-md-8 col-lg-6 col-xxl-4">';
                            echo '<div class="card mb-3">';
                            echo '<div class="card-body text-start">'; 
                            echo '<h4 class="card-title text_purple">#'.$linha["identificacao"].' Tinta '.$linha["cor"].':</h4>';
                            echo '<p class="card-text text_purple">Quantidade disponível: <span class="text_green">'.$linha["volume"].'L</span></p>';
                            echo '<p class="card-text text_purple">Data de validade: <span class="text_green">'.$dataValidade[2].'/'.$dataValidade[1].'/'.$dataValidade[0].'</span></p>';
                            echo '<p class="card-text text_purple">Data de recebimento: <span class="text_green">'.$dataRecebimento[2].'/'.$dataRecebimento[1].'/'.$dataRecebimento[0].'</span></p>';
                            echo '<p class="card-text text_purple">Marca: <span class="text_green">'.$linha["marca"].'</span></p>';
                            echo '<div class="row align-items-center">';
                            echo '<div class="col-sm-9 d-flex align-items-start">'; 
                            echo '<img class="img-fluid" src="'.$linha["imagem"].'" alt="" style="height: 150px; width: auto;">';
                            echo '</div>';
                            echo '<div class="col-sm-3 d-flex flex-column align-items-end">';
                            echo '<button class="btn btn-green btn_width trash_icon_position" id="btn-apagar'.$linha["identificacao"].'" onclick="modalApagar('.$linha["identificacao"].')">';
                            echo '<img src="./icones/lixo.png" class="icone_position" width="20px" height="20px" alt="icone lixeira">';    
                            echo 'Apagar Tinta';
                            echo '</button>';
                            echo '<form action="config/tintas_config.php" method="post"><input type="hidden" name="apagar-tinta"></input>';
                            echo '<input type="hidden" name="identificacao" value="'.$linha["identificacao"].'"></input>';
                            echo '<div id="modalBackgroundApagar'.$linha["identificacao"].'" class="modal-background"></div>';
                            echo '<div id="modalContainerApagar'.$linha["identificacao"].'" class="container-green">';
                            echo '<div class="fechar-modal" onclick="fecharModalApagar('.$linha["identificacao"].')"><img src="imagens/fechar.png" width="50px"></div>';
                            echo '<h4 class="text_purple pad_bottom_20">Apagar Tinta</h4>';
                            echo '<p class="apagar-tinta-mensagem">Deseja mesmo apagar esta tinta permanentemente?</p>';
                            echo '<button class="btn btn-purple-editar" id="btnApagar'.$linha["identificacao"].'">Apagar</button>';
                            echo '</div>';
                            echo '</form>';
                            echo '<button class="btn btn-green btn_width edit_icon_position" id="btn-alterar'.$linha["identificacao"].'" onclick="modal('.$linha["identificacao"].')">';
                            echo '<img src="./icones/editar.png" class="icone_position" width="20px" height="20px" alt="icone editar">';    
                            echo 'Alterar';
                            echo '</button>';
                            echo '<form action="config/tintas_config.php" method="post"><input type="hidden" name="alterar-tinta"></input>';
                            echo '<input type="hidden" name="identificacao" value="'.$linha["identificacao"].'"></input>';
                            echo '<div id="modalBackground'.$linha["identificacao"].'" class="modal-background"></div>';
                            echo '<div id="modalContainer'.$linha["identificacao"].'" class="container-green">';
                            echo '<div class="fechar-modal" onclick="fecharModal('.$linha["identificacao"].')"><img src="imagens/fechar.png" width="50px"></div>';
                            echo '<h4 class="text_purple pad_bottom_20">Alterar Tinta</h4>';
                            echo '<div class="form-group">';
                            echo '<label for="marcaTinta" class="text_purple">Marca:</label>';
                            echo '<input type="text" class="form-control input-small" placeholder="Marca" name="marca'.$linha["identificacao"].'">';
                            echo '</div>';
                            echo '<div class="form-group">';
                            echo '<label for="dataVencimento" class="text_purple">Data de Vencimento:</label>';
                            echo '<input type="date" class="form-control input-small" placeholder="12/05/2024" name="dataVencimento'.$linha["identificacao"].'">';
                            echo '</div>';
                            echo '<div class="form-group">';
                            echo '<label for="quantidadeLatas" class="text_purple">Data de recebimento</label>';
                            echo '<input type="date" class="form-control input-small" placeholder="12/05/2024" name="dataRecebimento'.$linha["identificacao"].'">';
                            echo '</div>';
                            echo '<div class="form-group pad_bottom_20">';
                            echo '<label for="volumeLitros" class="text_purple">Volume em Litros:</label>';
                            echo '<input name="volume'.$linha["identificacao"].'" type="number" step=".01" class="form-control input-small" placeholder="Volume em litros">';
                            echo '</div>';
                            echo '<button class="btn btn-purple-editar" id="btnSalvar'.$linha["identificacao"].'">Salvar</button>';
                            echo '</div>';
                            echo '</form>';
                            echo '</div>';
                            echo '</div>';
                            echo '</div>';
                            echo '</div>';
                            echo '</div>';
                        }
                    ?>
                    </div>
                </div>
            </div>
            
    </section>
    <script>
        function modal(id) {

            document.getElementById("modalBackground" + id).style.display = "block";
            document.getElementById("modalContainer" + id).style.display = "block";
            document.getElementById("modalContainer" + id).style.backgroundColor = "#8eb041";

            document.getElementById("btnSalvar" + id).addEventListener("click", function () {
                document.getElementById("modalBackground" + id).style.display = "none";
                document.getElementById("modalContainer" + id).style.display = "none";
            });

            document.getElementById("modalBackground").addEventListener("click", function () {
                document.getElementById("modalBackground" + id).style.display = "none";
                document.getElementById("modalContainer" + id).style.display = "none";
            });
        }

        function fecharModal(id) {
            document.getElementById("modalBackground" + id).style.display = "none";
            document.getElementById("modalContainer" + id).style.display = "none";
        }

        function modalApagar(id) {

            document.getElementById("modalBackgroundApagar" + id).style.display = "block";
            document.getElementById("modalContainerApagar" + id).style.display = "block";
            document.getElementById("modalContainerApagar" + id).style.backgroundColor = "#8eb041";

            document.getElementById("btnApagar" + id).addEventListener("click", function () {
                document.getElementById("modalBackgroundApagar" + id).style.display = "none";
                document.getElementById("modalContainerApagar" + id).style.display = "none";
            });

            document.getElementById("modalBackgroundApagar").addEventListener("click", function () {
                document.getElementById("modalBackgroundApagar" + id).style.display = "none";
                document.getElementById("modalContainerApagar" + id).style.display = "none";
            });
        }
        
        function fecharModalApagar(id) {
            document.getElementById("modalBackgroundApagar" + id).style.display = "none";
            document.getElementById("modalContainerApagar" + id).style.display = "none";
        }
    </script>
</body>

</html>