<?php
    if (session_status() !== PHP_SESSION_ACTIVE) 
    {
        session_start();
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
?>
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
                        <form id="form-pesquisa" action="php/tintas_config.php" method="POST">
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
                            echo '<form action="php/usuarios_config.php" method="post">';
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
                    <form id="form-pesquisa" action="php/tintas_config.php" method="POST">
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

                echo '<form action="php/usuarios_config.php" method="post">';
                echo '<input type="hidden" name="logout-usuario">';
                echo '<button type="submit" class="btn btn-danger">Sair</button>';
                echo '</form>';
            }
        ?>
        
    </div>
    <div class="menu-overlay" id="menuOverlay" onclick="toggleMenu()"></div>
</header>