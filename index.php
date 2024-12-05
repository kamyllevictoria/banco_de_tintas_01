<?php
    session_start();
    if(!(isset($_SESSION["mensagem-fazer-pedido"]))) {
        $_SESSION["mensagem-fazer-pedido"] = NULL;
    }

    if(!(isset($_SESSION["USUARIO"]))) {
        $_SESSION["USUARIO"] = NULL;
    }

    if(!(isset($_SESSION["ADM"]))) {
        $_SESSION["ADM"] = NULL;
    }
    
    if($_SESSION["USUARIO"] != NULL && $_SESSION["USUARIO"] != FALSE) {
        $clienteId = $_SESSION["USUARIO"];

        $conexao = mysqli_connect("localhost", "root", "","banco_tintas") or die ("Falha na conexão");
        $usuario = mysqli_query($conexao, "CALL clientes_carregarPor_id($clienteId)");
        $usuario = mysqli_fetch_array($usuario);
        mysqli_close($conexao);

        $nome = explode(" ", $usuario["nome"]);
        $nome = $nome[0];

        $foto = $usuario["foto"];
    }
    else {
        $foto = NULL;
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
    <title>Banco de Tintas | Fatec-JDI</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- CSS -->
    <link rel="stylesheet" href="./css/index.css">
    <link rel="stylesheet" href="./css/main.css">
    <link rel="stylesheet" href="./css/navbarLogado.css">
    <link rel="stylesheet" href="./css/navbarDeslog2.css">

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

    <link rel="shortcut icon" href="./icones/balde_tinta.png" type="image/x-icon">
</head>

<style>
    
    .card_transparent{
        background-color: transparent;
        border: none;
    }
    footer{
        background-color: #cfcece !important;
    }

    .input-small{
        width: 200px;
    }
    .pad_bottom_5{
        padding-bottom: 5px;
    }

    .form-group label {
        display: block;
        margin-bottom: 5px;
    }

    .form-group input {
        width: 100%;
        padding: 10px;
        margin: 0 auto;
        display: block;
        text-align: center;
        border-radius: 5px;
        border: none;
    }

    .btn-purple-editar {
        background-color: #84469B;
        color: white;
        font-size: 18px;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        width: 100%;
    }
    .btn-purple-editar:hover{
        background-color: #cbb4d3;
        color: black;
    }

    .container-green {
        display: none;
        background-color: #8eb041;
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        z-index: 1001;
        padding: 20px;
        border-radius: 10px;
        width: 400px; 
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
    }
    .modal-background {
        display: none; 
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5); 
        z-index: 1000; 
    }
    .fechar-modal {
        position: absolute;
        left: 100%;
        top: -10%;
        padding: 10px;
        cursor: pointer;
    } 

    .foto-perfil {
        border-radius: 30px;
    }

    .text_neon_green:hover {
        color: white;
    }

    #botao-flutuante-contraste {
        position: fixed;
        margin-left: 85%;
        margin-top: 3%;
        background-color: black;
        color:white;
        z-index: 1;
        padding: 10px;
        border-radius: 5px;
        box-shadow: 0px 0px 5px gray;
    }

    body.high-contrast .card-title,
    body.high-contrast .card-text{
        color: #8E9BE8;
    }

    .card-title, .card-text{
        color: black;
    }

    @media (max-width: 764px) {
        #botao-flutuante-contraste {
        margin-left: 75%;
        padding: 5px;
        font-size: 12px;
        }
    }

    @media (min-width: 765px) and (max-width: 1200px) {
        #botao-flutuante-contraste {
        margin-left: 75%;
        padding: 5px;
    }
    }
</style>

<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-custom">
            <div class="container">
                <div class="nao-sei d-flex justify-content-between align-items-center w-100">
                    <!-- Logo -->
                    <a class="navbar-brand d-flex align-items-center" href="index.php">
                        <img src="imagens/Logo.png" alt="Logo">
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
                            <img src="imagens/Logo.png" alt="Logo">
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
                        <?php
                            if($_SESSION["USUARIO"] == FALSE && $_SESSION["ADM"] == FALSE) {
                                echo '<a href="login.php" class="btn-login">Login</a>';
                                echo '<div class="navbar-end">';
                                echo '<a href="cadastro.php" class="btn btn-cadastre">Cadastre-se</a>';
                                echo '</div>';
                            }
                            else {
                                if($_SESSION["ADM"] == FALSE) {
                                    echo '<a class="ola">Olá, '.$nome.'!</a>';
                                }
                                else {
                                    echo '<a class="ola">Olá, Fatec!</a>';
                                }
                                echo '<div class="navbar-end dropdown">';
                                echo '<a href="#" class="d-flex align-items-center" data-bs-toggle="dropdown" aria-expanded="false">';
                                
                                if($foto == NULL) {
                                    echo '<img src="imagens/UsuarioVerde.png" alt="Foto de perfil" class="foto-perfil">';
                                }
                                else {
                                    echo '<img src="'.$foto.'" alt="Foto de perfil" class="foto-perfil">';
                                }
                                
                                echo '</a>';
                                echo '<ul class="dropdown-menu dropdown-menu-end">';
                                
                                if($_SESSION["ADM"] == FALSE) {
                                    echo '<li><a class="dropdown-item text-start" href="usuario.php">Minha conta</a></li>';
                                }
                                else {
                                    echo '<li><a class="dropdown-item text-start" href="catalogo.php">Administrativo</a></li>';
                                }

                                echo '<li><a class="dropdown-item text-start" href="#">';
                                echo '<form action="config/usuarios_config.php" method="post">';
                                echo '<input type="hidden" name="logout-usuario">';
                                echo '<button type="submit" class="btn btn-danger btn-sm">Sair</button>';
                                echo '</form>';
                                echo '</a></li>';
                                echo '</ul>';
                                echo '</div>'; 
                            }
                        ?>
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
            <?php
                if($_SESSION["USUARIO"] == FALSE && $_SESSION["ADM"] == FALSE) {
                    echo '<a href="login.php">Login</a>';
                    echo '<a href="cadastro.php">Cadastre-se</a>';
                }
                else {

                    if($_SESSION["ADM"] == FALSE) {
                        echo '<a class="d-flex align-items-center" href="usuario.php">';

                        if($foto == NULL) {
                            echo '<img src="imagens/UsuarioVerde.png" alt="Foto de perfil" class="foto-perfil">';
                        }
                        else {
                            echo '<img src="'.$foto.'" alt="Foto de perfil" class="foto-perfil">';
                        }
                        
                        echo '<span class="ola ms-2">Olá, '.$nome.'!</span>';
                        echo '</a>';
                        echo '<a href="usuario.php">Minha conta</a>';
                    }
                    else {
                        echo '<a href="catalogo.php">Administrativo</a>';
                    }

                    echo '<a href="quero_doar.php">Quero doar</a>';

                    echo '<form action="config/usuarios_config.php" method="post">';
                    echo '<input type="hidden" name="logout-usuario">';
                    echo '<button type="submit" class="btn btn-danger">Sair</button>';
                    echo '</form>';
                }
            ?>
            
        </div>
        <div class="menu-overlay" id="menuOverlay" onclick="toggleMenu()"></div>
    </header>

    <div id="botao-flutuante-contraste">
        <div class="form-check form-switch">
            <input class="form-check-input" type="checkbox" id="toggleHighContrast">
            <label class="form-check-label" for="toggleHighContrast">Alto Contraste</label>
        </div>
    </div>
    
    <section class="pagina">
        <div class="container">
            <?php
                $mensagem = $_SESSION["mensagem-fazer-pedido"];

                if($mensagem != NULL) {
                    echo '<div class="row mt-2">';
                    echo '<div class="col-12">';

                    if($mensagem == "Pedido efetuado.") {
                        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">';
                        echo '<strong>Sucesso!</strong>';
                    }
                    else {
                        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">';
                        echo '<strong>Pedido inválido!</strong>';
                    }
                    echo ' '.$mensagem;
                    echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';

                    $_SESSION["mensagem-fazer-pedido"] = NULL;
                }
            ?>
            <h2 class="title text_green padding_20">BANCO DE TINTAS</h2>
            <div class="row">
                <div class="col-md-6">
                    <img src="imagens/img2.avif" alt="imagem 1" class="img-fluid-custom">
                </div>
                <div class="col-md-6">
                    <p class="text_justify">As tintas são substâncias amplamente utilizadas em diversas áreas, como
                        arte, construção civil, design e indústria, sendo essenciais tanto para a decoração quanto para
                        a proteção de superfícies. Sua composição básica inclui pigmentos, responsáveis por proporcionar
                        a cor, e um meio líquido, conhecido como veículo, que permite sua aplicação. Após serem
                        aplicadas, o veículo evapora ou seca, deixando o pigmento fixo na superfície. <br>

                        <br>Existem diferentes tipos de tintas, cada uma adequada para uma finalidade específica. As
                        tintas à base de água, por exemplo, são muito comuns em pinturas domésticas e artísticas devido
                        à sua facilidade de uso e à rápida secagem. Além disso, são menos tóxicas e mais fáceis de
                        limpar, o que as torna populares para ambientes internos. Em contrapartida, as tintas à base de
                        solvente, que utilizam substâncias químicas em sua composição, são mais resistentes e duráveis,
                        sendo ideais para áreas externas, embora tenham um odor mais forte e levem mais tempo para
                        secar.
                    </p>
                </div>
            </div>
        </div>
    </section>


    <section class="section_2">
        <div class="container">
            <h2 class="title text_white padding_20 text-center">TINTAS DISPONÍVEIS</h2>

            <div class="row justify-content-center">

            <?php
              $cont = 1;

              while ($linha = mysqli_fetch_array($tabela)) {
                if(floatval($linha["volume"]) > 0) {

                    if($cont <= 4) {
                        echo '<div class="col-sm-6 col-lg-3 col-12 mb-4 px-5 px-sm-2">';
                        echo '<div class="card mx-auto">';
                        echo '<img src="'.$linha["imagem"].'" class="card-img-top mx-auto d-block card_img" alt="Imagem do Card 4" style="height: 230px;">';
                        echo '<div class="card-body">';
                        echo '<h5 class="card-title">Tinta '.$linha["cor"].'</h5>';
                        echo '<p class="card-text">Volume de '.$linha["volume"].'L</p>';
                        
                        if($_SESSION["ADM"] == FALSE && $_SESSION["USUARIO"] != FALSE) {
                          echo '<button onclick="modal('.$linha["identificacao"].')" class="btn btn-green btn-interesse btn_card">Tenho Interesse</button>';
                          echo '</div>';
                          echo '</div>';
                          echo '</div>';
                          echo '<div id="modalBackground'.$linha["identificacao"].'" class="modal-background"></div>';
                          echo '<div id="modalContainer'.$linha["identificacao"].'" class="container-green teste-modal">';
                          echo '<div class="fechar-modal" onclick="fecharModal('.$linha["identificacao"].')"><img src="imagens/fechar.png" width="50px"></div>';
                          echo '<h4 class="text_purple pad_bottom_20">Informe a quantidade da tinta desejada:</h4>';
                          echo '<form action="config/pedidos_config.php" method="post">';
                          echo '<input type="hidden" name="fazer-pedido">';
                          echo '<input type="hidden" name="identificacao" value="'.$linha["identificacao"].'"></input>';
                          echo '<div class="form-group pad_bottom_20">';
                          echo '<label for="volumeLitros" class="text_purple">Volume em Litros:</label>';
                          echo '<input name="volume'.$linha["identificacao"].'" type="number" step=".01" class="form-control input-small mb-2" id="volumeLitros" placeholder="Volume em litros">';
                          echo '</div>';
                          echo '<button class="btn btn-purple-editar" id="btnSalvar'.$linha["identificacao"].'">Solicitar Tinta</button>';
                          echo '</form>';
                          echo '</div>'; 
                        }
                        else {
                          echo '</div>';
                          echo '</div>';
                          echo '</div>';
                        }

                        $cont++;
                    }
                }
              }
            ?>

            </div>

            <div class="text-center">
                <a href='opcoes.php?acao=todos&valor=todos&page=1' class="text_a_link text_neon_green pad_top_20" style="display: inline-block;">Ver
                    mais opções</a>
            </div>
        </div>
    </section>

    <section class="section_3">
        <h2 class="title text_green pad_top_20 pad_bottom_20 text-center">PROJETO SOCIAL</h2>
        <div class="container">
            <div class="row justify-content-center">

                <div class="col-lg-3 col-md-6 col-12 mb-4">
                    <div class="card card_transparent mx-auto" style="max-width: 18rem;">
                        <img src="./icones/pincel.png" class="card-img-top mx-auto d-block card_img img-small"
                            alt="Imagem do Card 1">
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 col-12 mb-4">
                    <div class="card card_transparent mx-auto" style="max-width: 18rem;">
                        <img src="./icones/casa.png" class="card-img-top mx-auto d-block card_img img-small"
                            alt="Imagem do Card 2">
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 col-12 mb-4">
                    <div class="card card_transparent mx-auto" style="max-width: 18rem;">
                        <img src="./icones/balde_tinta.png" class="card-img-top mx-auto d-block card_img img-small"
                            alt="Imagem do Card 3">
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 col-12 mb-4">
                    <div class="card card_transparent mx-auto" style="max-width: 18rem;">
                        <img src="./icones/pessoa_balde.png" class="card-img-top mx-auto d-block card_img img-small"
                            alt="Imagem do Card 4">
                    </div>
                </div>

                <div class="col-12">
                    <p class="text_justify">As tintas são substâncias amplamente utilizadas em diversas áreas, como
                        arte, construção civil, design e indústria, sendo essenciais tanto para a decoração quanto para
                        a proteção de superfícies. Sua composição básica inclui pigmentos, responsáveis por proporcionar
                        a cor, e um meio líquido, conhecido como veículo, que permite sua aplicação. Após serem
                        aplicadas, o veículo evapora ou seca, deixando o pigmento fixo na superfície. <br>

                        <br>Existem diferentes tipos de tintas, cada uma adequada para uma finalidade específica. As
                        tintas à base de água, por exemplo, são muito comuns em pinturas domésticas e artísticas devido
                        à sua facilidade de uso e à rápida secagem. Além disso, são menos tóxicas e mais fáceis de
                        limpar, o que as torna populares para ambientes internos. Em contrapartida, as tintas à base de
                        solvente, que utilizam substâncias químicas em sua composição, são mais resistentes e duráveis,
                        sendo ideais para áreas externas, embora tenham um odor mais forte e levem mais tempo para
                        secar.
                    </p>
                </div>

            </div>
        </div>
    </section>

    <footer class="mt-5">
        <div class="container">
            <div class="row text-center">
                <div class="col-md-4 mb-4">
                    <p class="text_justify">Banco de tintas é uma iniciativa da FATEC Jundiaí!</p>
                    <p class="text_justify">
                        <img src="./icones/insta.png" width="50px" height="50px" alt="logo instagram"> <a
                            class="text_a_link text_purple" href="#">@fatecjd</a>
                    </p>

                    <p class="text_justify">
                        <img src="./icones/insta.png" width="50px" height="50px" alt="logo instagram">
                        <a class="text_a_link text_purple" href="#">@bancodetintasfatecjdi</a>
                    </p>
                </div>
                <div class="col-md-4 mb-4">
                    <img src="./icones/fatec_logo.png" alt="Logo" class="img-fluid" width="300px" height="50px">
                </div>
                <div class="col-md-4 mb-4">
                    <p>Av. União dos Ferroviários, 1760 - Centro, Jundiaí - SP, 13201-160</p>
                </div>
            </div>
        </div>
    </footer>
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

    </script>
</body>

</html>