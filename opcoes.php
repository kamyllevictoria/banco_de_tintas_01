<?php
    session_start();

    include 'php/phpBD/conexaoBD.php';
    include 'php/phpBD/usuariosBD.php';
    include 'php/phpBD/tintasBD.php';

    if(!(isset($_SESSION["USUARIO"]))) {
      $_SESSION["USUARIO"] = NULL;
    }

    if(!(isset($_SESSION["ADM"]))) {
        $_SESSION["ADM"] = NULL;
    }
    
    if($_SESSION["USUARIO"] != NULL && $_SESSION["USUARIO"] != FALSE) {
        $clienteId = $_SESSION["USUARIO"];
    }

    $acao = $_GET["acao"];
    $valor = $_GET["valor"];
    $page = $_GET["page"];

    if($acao == "cor") {
      $tintas = tintas_carregarPor_cor($mysqli, $valor);
    }
    else if($acao == "marca") {
      $tintas = tintas_carregarPor_marca($mysqli, $valor);
    }
    else {
      $tintas = tintas_carregar($mysqli);
    }
    
    $qtde_linhas = $tintas -> num_rows;
    $mysqli -> next_result();

    $qtd_paginas = intdiv($qtde_linhas, 9);
    $resto = $qtde_linhas % 9;

    if($qtd_paginas == 0) {
      $qtd_paginas = 1;
    }
    else if($resto > 0) {
      $qtd_paginas++;
    }

    if($page == 1) {
      $comeco = 1;
    }
    else {
      $comeco = 1 + ($qtd_paginas - 1) * 9;
    }
    
    $limite = $comeco + 9;
    $i = 1;
    $tabela = array();

    while($tinta = $tintas -> fetch_assoc()) {
      if($comeco < $limite) {
        if($i >= $comeco) {
          array_push($tabela, $tinta);
          $comeco++;
        }
      }

      $i++;
    }

    $marcas = tintas_carregar_marcas($mysqli);
    $mysqli -> next_result();

    $cores = tintas_carregar_cores($mysqli);
    $mysqli -> next_result();

    $url = $_SERVER["REQUEST_URI"];
    $partes = parse_url($url);
    parse_str($partes['query'], $query);
    $parametrosAtuais = "?acao=".$query["acao"]."&valor=".$query["valor"];
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
    <!-- <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/main.css"> -->
    <link rel="stylesheet" href="css/opcoes.css">
    <link rel="stylesheet" href="css/navbarLogado.css">
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

    <!-- Javascritp -->
    <script src="./js/scripts.js"></script>

    <link rel="shortcut icon" href="imagens/Logo.png" type="image/x-icon">

  </head>

<body>
  <?php include 'navbar.php'; ?>
  
  <div class="container-fluid p-4">
    <div class="row mb-2 justify-content-center">
      <!-- Filtros -->
      <div class="col-md-2 filter-box">
        <h5>Filtrar</h5>
        <p class="text-secondary">Marcas</p>
        <form action="php/tintas_config.php" method="post">
          <input type="hidden" name="filtrar-opcoes">
          <?php while($marca = $marcas -> fetch_assoc()): ?>
            <div class="form-check">
              <input class="form-check-input" type="checkbox" id="<?= $marca["marca"]."ID"; ?>" name="<?= $marca["marca"]; ?>" value="<?= $marca["marca"]; ?>"/>
              <label class="form-check-label" for="<?= $marca["marca"]."ID"; ?>"><?= $marca["marca"]; ?></label>
            </div>
          <?php endwhile; ?>
          <p class="text-secondary">Cores</p>
          <?php while($cor = $cores -> fetch_assoc()): ?>
            <div class="form-check">
              <input class="form-check-input" type="checkbox" id="<?= $cor["cor"]."ID"; ?>" name="<?= $cor["cor"]; ?>" value="<?= $cor["cor"]; ?>"/>
              <label class="form-check-label" for="<?= $cor["cor"]."ID"; ?>"><?= $cor["cor"]; ?></label>
            </div>
          <?php endwhile; ?>
          <button type="submit" class="btn-aplicar" id="btn-aplicar">Aplicar</button>
        </form>
      </div>

      <!-- Titulo, resultado, ordenar por, cards, paginação -->
      <div class="options col-md-9">
        <div class="d-flex justify-content-between align-items-center mb-3">
          <div>
            <!-- Titulo -->
            <h3 class="title fw-bold">Tintas disponíveis</h3>

            <!-- Resultado (Some no mobile)-->
            <span class="result">Foram encontrados <?= $qtde_linhas; ?> resultados para sua pesquisa</span>

            <!-- Ordenar do mobile-->
            <div class="selects-mobile d-flex align-items-center">
              <select class="select-mobile form-select">
                <option selected>Ordenar</option>
                <option value="1">Nome</option>
                <option value="2">Data</option>
                <option value="3">Quantidade</option>
              </select>
              <!-- Botão para sidebar de filtros no mobile -->
              <button class="btn-filtrar" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasFiltros" aria-controls="offcanvasFiltros">
                Filtrar
                <span class="arrow"><i class="fa-solid fa-angle-down"></i></span>
              </button>
              <!--Sidebar ------------------------------------->
              <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasFiltros" aria-labelledby="offcanvasFiltrosLabel">
                <div class="offcanvas-header">
                  <h5 class="offcanvas-title" id="offcanvasFiltrosLabel">Filtros</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Fechar"></button>
                </div>
                <div class="offcanvas-body">
                  <!-- Filtros ---------------->
                   <?php
                    $marcas = tintas_carregar_marcas($mysqli);
                    $mysqli -> next_result();

                    $cores = tintas_carregar_cores($mysqli);
                    $mysqli -> next_result();
                   ?>
                  <h5>Filtrar</h5>
                  <p class="text-secondary">Marcas</p>
                  <?php while($marca = $marcas -> fetch_assoc()): ?>
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" id="<?= $marca["marca"]."ID"; ?>" />
                      <label class="form-check-label" for="<?= $marca["marca"]."ID"; ?>"><?= $marca["marca"]; ?></label>
                    </div>
                  <?php endwhile; ?>
                  <p class="text-secondary">Cores</p>
                  <?php while($cor = $cores -> fetch_assoc()): ?>
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" id="<?= $cor["cor"]."ID"; ?>" />
                      <label class="form-check-label" for="<?= $cor["cor"]."ID"; ?>"><?= $cor["cor"]; ?></label>
                    </div>
                  <?php endwhile; ?>
                  <button type="button" class="btn-aplicar" id="btn-aplicar-mobile">Aplicar</button>
                </div>
              </div>
            </div>
          </div>
          
          <div class="selects d-flex align-items-center">
            <!-- Ordenar da tela grande --------------------------->
            <label for="ordem" class="form-label me-2">Ordenar por:</label>
            <select class="ordenar form-select">
              <option selected>Selecione</option>
              <option value="1">Nome</option>
              <option value="2">Data</option>
              <option value="3">Quantidade</option>
            </select>
            <!-- Ordenar do mobile (tamanho tablet) --------------------------------->
            <select class="ordenar-mobile form-select">
              <option selected>Ordenar</option>
              <option value="1">Nome</option>
              <option value="2">Data</option>
              <option value="3">Quantidade</option>
            </select>
            <!-- Botão para sidebar de filtros no mobile (tamanho tablet) ----------->
            <button class="filter" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasFiltros" aria-controls="offcanvasFiltros">
                Filtrar
                <span class="arrow"><i class="fa-solid fa-angle-down"></i></span>
              </button>
          </div>
        </div>

        <!-- 18 cards -->
        <div class="row row-cols-1 row-cols-md-3 g-4">
          <?php for($i = 0; $i < count($tabela); $i++): ?>
            <?php
              $dataValidade = explode("-", $tabela[$i]["dataValidade"]);
            ?>
            <div class="col">
              <div class="card p-3 h-100">
                <img src="<?= $tabela[$i]["imagem"]; ?>" alt="Tinta" class="img-fluid mb-2" style="max-height: 250px" />
                <h6 class="product-title mt-auto">Tinta <?= $tabela[$i]["cor"]; ?> - <?= $tabela[$i]["marca"]; ?></h6>
                <p class="mb-1"><strong>Quantidade disponível:</strong> <?= $tabela[$i]["volume"]; ?>L</p>
                <p class="mb-2">
                  <strong>Data de validade:</strong> 
                  <?= $dataValidade[2]; ?>/<?= $dataValidade[1]; ?>/<?= $dataValidade[0]; ?>
                </p>
                <button class="btn btn-interesse">Tenho Interesse</button>
              </div>
            </div>
          <?php endfor; ?>
        </div>

        <!-- Paginação -->
        <nav class="mt-4 d-flex justify-content-center">
          <ul class="pagination">
            <li class="page-item"><a class="page-link" href="#">&#x3C;</a></li>
            <?php for($i = 1; $i <= $qtd_paginas; $i++): ?>
              <?php $active = ($i == $page ? "active" : ""); ?>
              <li class="page-item <?= $active; ?>">
                <a class="page-link" href="<?= $parametrosAtuais; ?>&page=<?= $i; ?>"><?= $i; ?></a>
              </li>
            <?php endfor; ?>
            <li class="page-item"><a class="page-link" href="#">&#x3E;</a></li>
          </ul>
        </nav>

      </div>
    </div>
  </div>
  
  <!-- Footer -->
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
</body>

</html>