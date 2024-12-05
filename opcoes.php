<?php
    session_start();

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

    $acao = $_GET["acao"];
    $valor = $_GET["valor"];

    if($acao == "cor") {
      $tabela = mysqli_query($conexao, "CALL tintas_carregarPor_cor('$valor')");
    }
    else if($acao == "marca") {
      $tabela = mysqli_query($conexao, "CALL tintas_carregarPor_marca('$valor')");
    }
    else {
      $tabela = mysqli_query($conexao, "CALL tintas_carregar()");
    }

    $qtde_linhas = mysqli_num_rows($tabela);
    mysqli_close($conexao);
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tintas Disponíveis</title>


  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

  <!-- CSS -->
  <link rel="stylesheet" href="./css/index.css">
  <link rel="stylesheet" href="./css/main.css">
  <link rel="stylesheet" href="./css/opcoes.css">
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

  <style>
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

    body.high-contrast .justify-content-between,
    body.high-contrast .col-md-3,
    body.high-contrast .fw-bold,
    body.high-contrast .form-check-label {
      color: #8E9BE8 !important;
    }

    .justify-content-between,
    .col-md-3,
    .fw-bold,
    .form-check-label, h5 {
      color: black;
    }

    body.high-contrast .active>.page-link, .page-link.active {
      color: white !important;
      background-color: black !important;
      border-color: white !important;
    }

    .active>.page-link, .page-link.active {
      color: white !important;
      background-color: #84469b !important;
      border-color: #84469b !important;
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

  <div class="container">
    <div class="content-wrapper">
      <h2 class="text-center mb-4 text_purple mt-4">Tintas disponíveis</h2>
      <div class="row d-flex justify-content-center">
        <div class="col-md-1">
          <h5>Filtrar</h5>
          <div class="mb-3">
            <p class="fw-bold">Marcas</p>
            <div class="form-check">
              <input class="form-check-input" type="checkbox" id="marcaSaci">
              <label class="form-check-label" for="marcaSaci">Saci</label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="checkbox" id="marcaDorti">
              <label class="form-check-label" for="marcaDorti">Dorti</label>
            </div>
          </div>
        </div>

        <div class="col-md-9">
          <div class="row g-4">
            <?php
                $cont = 1;
                $page = $_GET["page"];
                $pageCont = 1;
                $coresDisponiveis = "";
                $coresIndisponiveis = "";

                  while ($linha = mysqli_fetch_array($tabela)) {
                    if(floatval($linha["volume"]) > 0) {
                      $pageCont++;
                      $coresDisponiveis = $coresDisponiveis.";".$linha["cor"];
                      $dataValidade = explode('-', $linha["dataValidade"]);

                      if($page == 1) {
                        if($cont >= $page && $cont <= $page + 3) {
                          if($cont % 2 == 0) {
                            echo '<div class="col-md-6">';
                          }
                          else {
                            echo '<div class="col-md-6 d-flex justify-content-end">';
                          }
                          echo '<div class="product-card p-3" style="width:80%">';
                          echo '<img src="'.$linha["imagem"].'" alt="Tinta verde" style="height:230px">';
                          echo '<h5 class="mt-3">Tinta '.$linha["cor"].'</h5>';
                          echo '<p>Quantidade disponível: '.$linha["volume"].'L</p>';
                          echo '<p>Data de validade: '.$dataValidade[2].'/'.$dataValidade[1].'/'.$dataValidade[0].'</p>';
                          
                          if($_SESSION["ADM"] == FALSE && $_SESSION["USUARIO"] != FALSE) {
                            echo '<button onclick="modal('.$linha["identificacao"].')" class="btn btn-green btn_card">Tenho Interesse</button>';
                            echo '</div>';
                            echo '</div>';
                            echo '<div id="modalBackground'.$linha["identificacao"].'" class="modal-background"></div>';
                            echo '<div id="modalContainer'.$linha["identificacao"].'" class="container-green">';
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
                          }
                        }
                      }
                      else if($page > 1) {
                        if($cont >= $page + 3 && $cont <= $page + 6) {
                          if($cont % 2 == 0) {
                            echo '<div class="col-md-6">';
                          }
                          else {
                            echo '<div class="col-md-6 d-flex justify-content-end">';
                          }
                          echo '<div class="product-card p-3" style="width:80%">';
                          echo '<img src="'.$linha["imagem"].'" alt="Tinta verde" style="height:230px">';
                          echo '<h5 class="mt-3">Tinta '.$linha["cor"].'</h5>';
                          echo '<p>Quantidade disponível: '.$linha["volume"].'L</p>';
                          echo '<p>Data de validade: 10/12/2024</p>';
                          
                          if($_SESSION["ADM"] == FALSE && $_SESSION["USUARIO"] != FALSE) {
                            echo '<button onclick="modal('.$linha["identificacao"].')" class="btn btn-green btn_card">Tenho Interesse</button>';
                            echo '</div>';
                            echo '</div>';
                            echo '<div id="modalBackground'.$linha["identificacao"].'" class="modal-background"></div>';
                            echo '<div id="modalContainer'.$linha["identificacao"].'" class="container-green">';
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
                          }
                        }
                      }
  
                      $cont++;
                    }
                    else {
                      $coresIndisponiveis = $coresIndisponiveis.";".$linha["cor"];
                    }
                    
                  }

                  if($_SESSION["ADM"] == FALSE && $_SESSION["USUARIO"] != FALSE) {
                    $coresDisponiveis = explode(";", $coresDisponiveis);
                    $coresIndisponiveis = explode(";", $coresIndisponiveis);

                    $coresIndisponiveis = array_diff($coresIndisponiveis, $coresDisponiveis);

                    $cont = 1;

                    for($i = 1; $i < count($coresIndisponiveis); $i++) {

                      $cor = $coresIndisponiveis[$i];

                      $conexao = mysqli_connect("localhost", "root", "","banco_tintas") or die ("Falha na conexão");
                      $tabela = mysqli_query($conexao, "CALL tintas_carregarPor_cor('$cor')");
                      mysqli_close($conexao);

                      $clienteId = $_SESSION["USUARIO"];
                      $conexao = mysqli_connect("localhost", "root", "","banco_tintas") or die ("Falha na conexão");
                      $tabelaLista = mysqli_query($conexao, "CALL listaDesejos_carregarPor_clienteId($clienteId)");
                      mysqli_close($conexao);

                      $temLista = false;

                      while($lista = mysqli_fetch_array($tabelaLista)) {
                          if($lista["cor"] == $cor) {
                              $temLista = true;
                          }
                      }

                      $cont2 = 1;

                      while ($linha = mysqli_fetch_array($tabela)) {
                          if($temLista) {
                              if($cont2 == 1) {
                                  if($page == 1) {
                                    if($cont >= $page && $cont <= $page + 3) {
                                      if($cont % 2 == 0) {
                                        echo '<div class="col-md-6">';
                                      }
                                      else {
                                        echo '<div class="col-md-6 d-flex justify-content-end">';
                                      }
                                      echo '<div class="product-card p-3" style="width:80%">';
                                      echo '<img src="img-bd/padrao.jpg" alt="Tinta verde" style="height:230px; filter:grayscale(100%);">';
                                      echo '<h5 class="mt-3">Tinta '.$cor.'</h5>';
                                      echo '<p>Indisponível</p>';
                                      echo '<a href="usuario.php">';
                                      echo '<button class="btn btn-secondary btn_card">';
                                      echo '<img src="imagens/coracao.png" width="20px" style="margin-right:10px;">';
                                      echo 'Salvo';
                                      echo '</button>';
                                      echo '</a>';
                                      echo '</div>';
                                      echo '</div>';
                                    }
                                  }
                                  else if($page > 1) {
                                    if($cont >= $page + 3 && $cont <= $page + 6) {
                                      if($cont % 2 == 0) {
                                        echo '<div class="col-md-6">';
                                      }
                                      else {
                                        echo '<div class="col-md-6 d-flex justify-content-end">';
                                      }
                                      echo '<div class="product-card p-3" style="width:80%">';
                                      echo '<img src="img-bd/padrao.jpg" alt="Tinta verde" style="height:230px; filter:grayscale(100%);">';
                                      echo '<h5 class="mt-3">Tinta '.$cor.'</h5>';
                                      echo '<p>Indisponível</p>';
                                      echo '<a href="usuario.php">';
                                      echo '<button class="btn btn-secondary btn_card">';
                                      echo '<img src="imagens/coracao.png" width="20px" style="margin-right:10px;">';
                                      echo 'Salvo';
                                      echo '</button>';
                                      echo '</a>';
                                      echo '</div>';
                                      echo '</div>';
                                    }
                                  }
              
                                  $cont2++;
                              }
                          }
                          else {
                              if($cont == 1) {
                                if($page == 1) {
                                  if($cont >= $page && $cont <= $page + 3) {
                                    if($cont % 2 == 0) {
                                      echo '<div class="col-md-6">';
                                    }
                                    else {
                                      echo '<div class="col-md-6 d-flex justify-content-end">';
                                    }
                                    echo '<div class="product-card p-3" style="width:80%">';
                                    echo '<img src="img-bd/padrao.jpg" alt="Tinta verde" style="height:230px; filter:grayscale(100%);">';
                                    echo '<h5 class="mt-3">Tinta '.$cor.'</h5>';
                                    echo '<p>Indisponível</p>';
                                    echo '<form action="config/pedidos_config.php" method="post">';
                                    echo '<input type="hidden" name="lista-desejos">';
                                    echo '<input type="hidden" name="identificacao" value="'.$linha["identificacao"].'">';
                                    echo '<button type="submit" class="btn btn-secondary btn_card">';
                                    echo '<img src="imagens/coracao-vazio.png" width="20px" style="margin-right:10px;">';
                                    echo 'Salvar';
                                    echo '</button>';
                                    echo '</form>';
                                    echo '</div>';
                                    echo '</div>';
                                  }
                                }
                                else if($page > 1) {
                                  if($cont >= $page + 3 && $cont <= $page + 6) {
                                    if($cont % 2 == 0) {
                                      echo '<div class="col-md-6">';
                                    }
                                    else {
                                      echo '<div class="col-md-6 d-flex justify-content-end">';
                                    }
                                    echo '<div class="product-card p-3" style="width:80%">';
                                    echo '<img src="img-bd/padrao.jpg" alt="Tinta verde" style="height:230px; filter:grayscale(100%);">';
                                    echo '<h5 class="mt-3">Tinta '.$cor.'</h5>';
                                    echo '<p>Indisponível</p>';
                                    echo '<form action="config/pedidos_config.php" method="post">';
                                    echo '<input type="hidden" name="lista-desejos">';
                                    echo '<input type="hidden" name="identificacao" value="'.$linha["identificacao"].'">';
                                    echo '<button type="submit" class="btn btn-secondary btn_card">';
                                    echo '<img src="imagens/coracao-vazio.png" width="20px" style="margin-right:10px;">';
                                    echo 'Salvar';
                                    echo '</button>';
                                    echo '</form>';
                                    echo '</div>';
                                    echo '</div>';
                                  }
                                }

                                $cont2++;
                              }
                          }

                          $cont++;
                      }
                  }
                  }

                ?>
            </div>
        </div>

        <div class="col-md-1">
          <div class="d-flex justify-content-between align-items-center mb-3">
            <select class="form-select w-auto" aria-label="Ordenar por">
              <option selected>Ordenar por</option>
              <option value="2">Volume</option>
              <option value="3">Data de validade</option>
            </select>
          </div>
        </div>

        <nav aria-label="Page navigation" class="mt-4">
          <ul class="pagination justify-content-center">
            <?php 
              $cont = 1;
              $cont2 = 2;
              $page = $_GET["page"];
              $pageProx = $page + 1;
              $pageAnte = $page - 1;

              $conexao = mysqli_connect("localhost", "root", "","banco_tintas") or die ("Falha na conexão");
              $tabela = mysqli_query($conexao, "CALL tintas_carregar()");
              mysqli_close($conexao);

              if($qtde_linhas / 4 > 1) {
                if($pageAnte == 0) {
                  echo '<li class="page-item disabled">';
                  echo '<a class="page-link" href="#" tabindex="-1" aria-disabled="true">&laquo;</a>';
                  echo '</li>';
                }
                else {
                  echo '<li class="page-item">';
                  echo '<a class="page-link" href="?acao='.$acao.'&valor='.$valor.'&page='.$pageAnte.'">&raquo;</a>';
                  echo '</li>';
                }
                        
                while ($linha = mysqli_fetch_array($tabela)) {
                  if($cont2 % 4 == 0) {
                    if($cont == $page) {
                      echo '<li id="page'.$cont.'" class="page-item active"><a class="page-link" href="?acao='.$acao.'&valor='.$valor.'&page='.$cont.'">'.$cont.'</a></li>';
                    }
                    else {
                      echo '<li id="page'.$cont.'" class="page-item"><a class="page-link" href="?acao='.$acao.'&valor='.$valor.'&page='.$cont.'">'.$cont.'</a></li>';
                    }
                    
                    $cont++;
                  }
  
                  $cont2++;
                }
  
                if($pageProx <= $qtde_linhas / 4) {
                  echo '<li class="page-item">';
                  echo '<a class="page-link" href="?acao='.$acao.'&valor='.$valor.'&page='.$pageProx.'">&raquo;</a>';
                  echo '</li>';
                }
                else {
                  echo '<li class="page-item disabled">';
                  echo '<a class="page-link" href="#">&raquo;</a>';
                  echo '</li>';
                }
              }
            ?>
          </ul>
        </nav>

      </div>
        
    </div>
  </div>
  <footer class="mt-5">
    <div class="container">
      <div class="row text-center">
        <div class="col-md-4 mb-4">
          <p class="text_justify">Banco de tintas é uma iniciativa da FATEC Jundiaí!</p>

          <p class="text_justify">
            <img src="./icones/insta.png" width="50px" height="50px" alt="logo instagram">
            <a class="text_a_link text_purple" href="#">@fatecjd</a>
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
  <!--script do novo modal -->
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

    const input = document.getElementById('Pesquisa');

    input.addEventListener('keypress', function(event) {
      if (event.key === 'Enter') {
        event.preventDefault();
        document.getElementById("form-pesquisa").submit();
      }
    });

    function fecharModal(id) {
        document.getElementById("modalBackground" + id).style.display = "none";
        document.getElementById("modalContainer" + id).style.display = "none";
    }

  </script>
</body>

</html>