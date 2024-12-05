<?php
    session_start();

    if(!(isset($_SESSION["mensagem-aprovar-pedido"]))) {
        $_SESSION["mensagem-aprovar-pedido"] = NULL;
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
    $tabela = mysqli_query($conexao, "CALL pedidos_carregar()");
    mysqli_close($conexao);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bem vindo | Pedidos</title>

    <!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- CSS -->
    <link rel="stylesheet" href="./css/main.css">
    <link rel="stylesheet" href="./css/pedidos.css">
    <link rel="stylesheet" href="./css/navbarLogado.css">

    <!-- script -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Javascritp -->
    <script src="./js/scripts.js"></script>

    <!-- FontAwesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" rel="stylesheet">

    <link rel="shortcut icon" href="./icones/balde_tinta.png" type="image/x-icon">

    <style>
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

    <section class="pedidos">
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
                        $mensagem = $_SESSION["mensagem-aprovar-pedido"];

                        if($mensagem != NULL) {
                            echo '<div class="row mt-2">';
                            echo '<div class="col-12">';

                            if($mensagem == "Status do pedido confirmado.") {
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

                            $_SESSION["mensagem-aprovar-pedido"] = NULL;
                        }
                    ?>
                    <h4 class="text_green_2 text-center text-lg-start">PEDIDOS A SEREM APROVADOS</h4>
                    <div class="row cards-container">

                        <?php
                            $cont = 1;

                            while ($linha = mysqli_fetch_array($tabela)) {
                                
                                $conexao = mysqli_connect("localhost", "root", "","banco_tintas") or die ("Falha na conexão");

                                $dataHora = $linha["dataHora"];
                                $tintasIdentificacao = $linha["tintasIdentificacao"];
                                $clienteId = $linha["clienteId"];

                                $pedidoStatus = mysqli_query($conexao, "CALL pedidoStatus_carregarPor_pedidosIds('$dataHora', '$tintasIdentificacao', '$clienteId')");
                                mysqli_close($conexao);

                                $qtde_linhas = mysqli_num_rows($pedidoStatus);

                                if($qtde_linhas == 0) {

                                    $conexao = mysqli_connect("localhost", "root", "","banco_tintas") or die ("Falha na conexão");

                                    $cliente = mysqli_query($conexao, "CALL clientes_carregarPor_id('$clienteId')");
                                    $cliente = mysqli_fetch_array($cliente);
                                    mysqli_close($conexao);
    
                                    $conexao = mysqli_connect("localhost", "root", "","banco_tintas") or die ("Falha na conexão");
    
                                    $tinta = mysqli_query($conexao, "CALL tintas_carregarPor_identificacao('$tintasIdentificacao')");
                                    $tinta = mysqli_fetch_array($tinta);
                                    mysqli_close($conexao);
    
                                    $data = str_replace(' ', ":", $linha["dataHora"]);
                                    $data = str_replace('-', ":", $data);
                                    $dataHora = explode(':', $data);
    
                                    echo '<div class="col-12 col-sm-10 col-md-8 col-lg-6 col-xxl-4">';
                                    echo '<div class="card">';
                                    echo '<div class="card-body text-start">';
                                    echo '<h4 class="card-title text_purple">Pedido: '.$dataHora[2].'/'.$dataHora[1].'/'.$dataHora[0].' '.$dataHora[3].':'.$dataHora[4].':'.$dataHora[5].'</h4>';
                                    echo '<p class="card-text text_purple">Solicitado por: <span class="text_green">'.$cliente["nome"].'</span></p>';
                                    echo '<p class="card-text text_purple">Quantidade: <span class="text_green">'.$linha["volume"].'L</span></p>';
                                    echo '<p class="card-text text_purple">Identificação da tinta: <span class="text_green">'.$tintasIdentificacao.'</span></p>';
                                    echo '<p class="card-text text_purple">Cor: <span class="text_green">'.$tinta["cor"].'</span></p>';
                                    echo '<form action="config/pedidos_config.php" method="post">';
                                    echo '<input type="hidden" name="clienteId" value="'.$clienteId.'">';
                                    echo '<div class="status-container">';
                                    echo '<p class="text_magenta">Status do pedido:</p>';
                                    echo '<select name="statusOpcoes'.$tintasIdentificacao.'" id="statusOpcoe'.$cont.'" onchange="opcoes('.$cont.')" class="statusDropdown form-select">';
                                    echo '<option value="">Selecione...</option>';
                                    echo '<option value="1">Aprovado</option>';
                                    echo '<option value="2">Parcialmente Aprovado</option>';
                                    echo '<option value="3">Reprovado</option>';
                                    echo '</select>';
                                    echo '</div>';
                                    echo '<input type="hidden" name="aprovar-pedido">';
                                    echo '<input type="hidden" name="identificacao" value="'.$tintasIdentificacao.'">';
                                    echo '<input type="hidden" name="dataHora" value="'.$linha["dataHora"].'">';
                                    echo '<div id="formularioRetirada'.$cont.'" class="formulario-retirada" style="display:none;">';
                                    echo '<div class="campo-data-hora">';
                                    echo '<label for="data_retirada">Data de retirada:</label>';
                                    echo '<input type="date" name="data_retirada'.$tintasIdentificacao.'" id="Data_retirada'.$tintasIdentificacao.'">';
                                    echo '</div>';
                                    echo '<div class="campo-data-hora">';
                                    echo '<label for="hora_retirada">Horário para Retirada:</label>';
                                    echo '<input type="time" name="hora_retirada'.$tintasIdentificacao.'" id="Hora_retirada'.$tintasIdentificacao.'">';
                                    echo '</div>';
                                    echo '</div>';
                                    echo '<div class="formulario-observacoes"  id="formularioObservacoes'.$cont.'" style="display:none; margin-top: 5px;">';
                                    echo '<textarea name="observacoes'.$tintasIdentificacao.'" id="Observacoes'.$tintasIdentificacao.'" style="width: 100%;" placeholder="Observações"></textarea>';
                                    echo '</div>';
                                    echo '<div id="salvarDados'.$cont.'" style="display: none;">';
                                    echo '<button class="btn-green btn" style="margin-top: 5px;">Salvar dados</button>';
                                    echo '</div>';
                                    echo '</form>';
                                    echo '</div>';
                                    echo '</div>';
                                    echo '</div>';

                                    $cont++;
                                }
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
        document.querySelectorAll('.statusDropdown').forEach((dropdown) => {
            dropdown.addEventListener('change', function () {
                const status = this.value;
                const statusTextDiv = this.closest('.card-body').querySelector('.statusText');

                if (status) {
                    statusTextDiv.textContent = `Status: ${status.charAt(0).toUpperCase() + status.slice(1)}`;
                } else {
                    statusTextDiv.textContent = '';
                }
            });
        });
    </script>

    <script>
        function opcoes(id) {
            let statusDropdown = document.getElementById("statusOpcoe" + id);
            let status = statusDropdown.value;

            let formularioRetirada = document.getElementById("formularioRetirada" + id);
            let formularioObservacoes = document.getElementById("formularioObservacoes" + id);
            let btnSalvarDados = document.getElementById("salvarDados" + id);

            let data = document.getElementById("Data_retirada" + id);
            let hora = document.getElementById("Hora_retirada" + id);
            let observacoes = document.getElementById("Observacoes" + id);

            if (status === "1") {
                formularioRetirada.style.display = 'block';
                formularioObservacoes.style.display = 'none';
                btnSalvarDados.style.display = 'block';

            } else if (status === "2") {
                formularioRetirada.style.display = 'block';
                formularioObservacoes.style.display = 'block';
                btnSalvarDados.style.display = 'block';

            } else if (status == "3") {
                formularioRetirada.style.display = 'none';
                formularioObservacoes.style.display = 'block';
                btnSalvarDados.style.display = 'block';
            }
            else {
                formularioRetirada.style.display = 'none';
                formularioObservacoes.style.display = 'none';
                btnSalvarDados.style.display = 'none';
            }
        }
    </script>
</body>
</html>