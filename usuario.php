<?php
    session_start();

    if($_SESSION["ADM"] != FALSE) {
        header('location: catalogo.php');
    }

    if(!(isset($_SESSION["cadastro-login"]))) {
        $_SESSION["cadastro-login"] = NULL;
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

    $conexao = mysqli_connect("localhost", "root", "","banco_tintas") or die ("Falha na conexão");
    $tabela = mysqli_query($conexao, "CALL pedidos_carregarPor_clienteId($clienteId)");
    mysqli_close($conexao);
?>

<!DOCTYPE html>
<html lang="pt-BR">

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
    <link rel="stylesheet" href="css/usuario.css">
    <link rel="stylesheet" href="css/navbarLogado.css">

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

    <title>Banco de Tintas</title>

    <style>
        .foto-perfil {
            border-radius: 30px;
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
                        <a class="ola"> Olá, <?php echo $nome?>!</a>

                        <!-- Dropdown com foto de perfil -->
                        <div class="navbar-end dropdown">
                            <a href="#" class="d-flex align-items-center" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                <?php
                                    if($foto == NULL) {
                                        echo '<img src="imagens/UsuarioVerde.png" alt="Foto de perfil" class="foto-perfil">';
                                    }
                                    else {
                                        echo '<img src="'.$foto.'" alt="Foto de perfil" class="foto-perfil">';
                                    }
                                ?>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item text-start" href="usuario.php">Minha conta</a></li>
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
            <a class="d-flex align-items-center" href="usuario.php">
            <?php
                if($foto == NULL) {
                    echo '<img src="imagens/UsuarioVerde.png" alt="Foto de perfil" class="foto-perfil">';
                }
                else {
                    echo '<img src="'.$foto.'" alt="Foto de perfil" class="foto-perfil">';
                }
            ?>
                <span class="ola ms-2">Olá, <?php echo $nome?>!</span>
            </a>
            <br>
            <a href="quero_doar.php">Quero doar</a>
            <a href="usuario.php">Minha conta</a>
            <a href="#">
            <form action="config/usuarios_config.php" method="post">
                <input type="hidden" name="logout-usuario">
                <button type="submit" class="btn btn-danger">Sair</button>
            </form>
            </a>
        </div>
        <div class="menu-overlay" id="menuOverlay" onclick="toggleMenu()"></div>
    </header>

    <div class="container my-5 pagina ">
        <?php
            $mensagem = $_SESSION["cadastro-login"];

            if($mensagem != NULL) {
                echo '<div class="row mt-2">';
                echo '<div class="col-12">';

                if($mensagem == "Dados atualizados." || $mensagem == "Foto removida.") {
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

                $_SESSION["cadastro-login"] = NULL;
            }
        ?>
        <h1 class="mb-4">Perfil do Usuário</h1>

        <!-- Navegação por abas -->

        <ul class="nav nav-tabs" id="profileTabs" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="info-tab" data-bs-toggle="tab" data-bs-target="#info" type="button"
                    role="tab">Informações Pessoais</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="orders-tab" data-bs-toggle="tab" data-bs-target="#orders" type="button"
                    role="tab">Meus Pedidos</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="wishlist-tab" data-bs-toggle="tab" data-bs-target="#wishlist" type="button"
                    role="tab">Lista de Desejos</button>
            </li>
        </ul>

        <!-- Conteúdo das abas -->
        <div class="tab-content mt-3 justify-content-center" id="profileTabsContent">

            <!-- Aba de Informações Pessoais -->
            <div class="tab-pane fade show active" id="info" role="tabpanel" aria-labelledby="info-tab">
                <div class="dados_pessoais">
                    <div class="profile-img mx-auto mb-3">
                        <?php
                            if($foto == "") {
                                echo '<span><img class="usuario" src="imagens/Usuario.png" alt="Imagem do Usuario"></span>';
                            }
                            else {
                                echo '<span><img class="usuario" src="'.$foto.'" alt="Imagem do Usuario" style="border-radius: 100px;"></span>';
                            }
                        ?>
                    </div>
                    <div class="d-flex justify-content-center my-3">
                        <form action="config/usuarios_config.php" method="post">
                            <input type="hidden" name="remover-foto">
                            <button type="submit" class="btn btn-danger">Remover foto atual</button>
                        </form>
                    </div>

                    <form action="config/usuarios_config.php" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="alterar-usuario">
                        <div class="d-flex justify-content-center">
                            <input type="file" id="fileInput" name="foto">
                        </div>
                        
                        <!-- Nome -->
                        <div class="mb-3">
                            <label for="formInput" class="form-label">Nome</label>
                            <input type="text" class="form-control" id="Nome" name="nome">
                        </div>

                        <!-- e-mail -->
                        <div class="mb-3">
                            <label for="formInput" class="form-label">E-mail</label>
                            <input type="email" class="form-control" id="Email" placeholder="seu-email@gmail.com" name="email">
                        </div>
                        <!-- Telefone -->
                        <div class="mb-3">
                            <label for="formInput" class="form-label">Telefone</label>
                            <input type="tel" class="form-control" id="Telefone" placeholder="(00) 00000-0000" name="telefone">
                        </div>

                        <!-- aqui--------------------------- -->
                        <div class="form-check form-switch mb-4">
                            <input class="form-check-input" type="checkbox" id="toggleHighContrast">
                            <label class="form-check-label" for="toggleHighContrast">Ativar Alto Contraste</label>
                        </div>
                        <!-- aqui--------------------------- -->
                         
                        <button type="submit" class="btn btn-purple w-100">Salvar</button>
                    </form>
                </div>
            </div>

            <!-- Aba de Meus Pedidos com Accordion -->
            <div class="tab-pane fade" id="orders" role="tabpanel" aria-labelledby="orders-tab">
                <div class="d-flex justify-content-center">
                    <div class="accordion" id="ordersAccordion">
                        <!-- Pedido #1 -->
                        <?php
                        $cont = mysqli_num_rows($tabela);

                        while ($linha = mysqli_fetch_array($tabela)) {
                            $conexao = mysqli_connect("localhost", "root", "","banco_tintas") or die ("Falha na conexão");

                            $dataHora = $linha["dataHora"];
                            $tintasIdentificacao = $linha["tintasIdentificacao"];
                            $clienteId = $linha["clienteId"];

                            $pedidoStatusTabela = mysqli_query($conexao, "CALL pedidoStatus_carregarPor_pedidosIds('$dataHora', '$tintasIdentificacao', '$clienteId')");
                            $pedidoStatus = mysqli_fetch_array($pedidoStatusTabela);

                            $status = "Aguardando confirmação";
                            $color = "orange";

                            $dataHora = ["--", "--", "--", "--", "--", "--"];

                            if(mysqli_num_rows($pedidoStatusTabela) > 0) {
                                
                                $status = $pedidoStatus["status"];

                                $data = str_replace(' ', ":", $pedidoStatus["dataHoraRetirada"]);
                                $data = str_replace('-', ":", $data);
                                $dataHora = explode(':', $data);

                                if($status == "Aprovado" || $status == "Parcialmente aprovado") {
                                    $color = "green";
                                }
                                else if($status == "Reprovado") {
                                    $color = "red";
                                }
                                
                            }
                            mysqli_close($conexao);

                            $conexao = mysqli_connect("localhost", "root", "","banco_tintas") or die ("Falha na conexão");
    
                            $tinta = mysqli_query($conexao, "CALL tintas_carregarPor_identificacao('$tintasIdentificacao')");
                            $tinta = mysqli_fetch_array($tinta);
                            mysqli_close($conexao);

                            echo '<div class="accordion-item">';
                            echo '<h2 class="accordion-header" id="'.$cont.'">';
                            echo '<button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse'.$cont.'" aria-expanded="true" aria-controls="collapse'.$cont.'">';
                            echo 'Pedido #'.$cont.' - '.$status.'';
                            echo '</button>';
                            echo '</h2>';
                            echo '<div id="collapse'.$cont.'" class="accordion-collapse collapse" aria-labelledby="'.$cont.'" data-bs-parent="#ordersAccordion">';
                            echo '<div class="accordion-body">';
                            echo '<p>Detalhes do pedido #'.$cont.':</p>';
                            echo '<ul>';
                            echo '<li>Tinta '.$tinta["cor"].'</li>';
                            echo '<li>Quantidade: '.$linha["volume"].' litros</li>';
                            echo '<li>Status: <span style="color: '.$color.';">'.$status.'</span></li>';
                            echo '<li>Data de retirada: '.$dataHora[2].'/'.$dataHora[1].'/'.$dataHora[0].'</li>';
                            echo '<li>Hora: '.$dataHora[3].':'.$dataHora[4].':'.$dataHora[5].'</li>';

                            if($status == "Reprovado" || $status == "Parcialmente aprovado") {
                                echo '<li>Observações: '.$pedidoStatus["observacoes"].'</li>';
                            }

                            echo '</ul>';
                            echo '<img src="'.$tinta["imagem"].'" class="img-fluid">';
                            echo '</div>';
                            echo '</div>';
                            echo '</div>';

                            $cont--;
                        }
                    ?>
                    </div>
                </div>
            </div>

            <!-- Aba de Lista de Desejos -->
            <div class="tab-pane fade" id="wishlist" role="tabpanel" aria-labelledby="wishlist-tab">
                <div class="row">
                    <?php
                        $clienteId = $_SESSION["USUARIO"];
                        $conexao = mysqli_connect("localhost", "root", "","banco_tintas") or die ("Falha na conexão");
                        $tabela = mysqli_query($conexao, "CALL listaDesejos_carregarPor_clienteId($clienteId)");
                        mysqli_close($conexao);

                        while($linha = mysqli_fetch_array($tabela)) {
                            $identificacao = $linha["tintasIdentificacao"];
                            $conexao = mysqli_connect("localhost", "root", "","banco_tintas") or die ("Falha na conexão");
                            $tinta = mysqli_query($conexao, "CALL tintas_carregarPor_identificacao('$identificacao')");
                            $tinta = mysqli_fetch_array($tinta);
                            mysqli_close($conexao);

                            echo '<div class="col-md-4 mb-3">';
                            echo '<div class="card h-100">';    
                            echo '<img src="'.$tinta["imagem"].'" class="card-img-top" alt="Imagem do Produto A">';
                            echo '<div class="card-body d-flex flex-column">';
                            echo '<h5 class="card-title">Tinta '.$tinta["cor"].'</h5>';
                            echo '<div class="mt-auto d-flex justify-content-end">';
                            echo '<form action="config/pedidos_config.php" method="post">';
                            echo '<input type="hidden" name="remover-lista-desejos" />';
                            echo '<input type="hidden" name="cor" value="'.$tinta["cor"].'"/>';
                            echo '<button type="submit" class="btn btn-outline-danger w-100 btn-sm">Remover</button>';
                            echo '</form>';
                            echo '</div>';
                            echo '</div>';
                            echo '</div>';
                            echo '</div>';
                        }
                    ?>
                </div>
            </div>
        </div>
    </div>
</body>

</html>