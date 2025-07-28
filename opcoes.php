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

        $usuario = clientes_carregarPor_id($mysqli, $clienteId);
        $usuario = $usuario -> fetch_assoc();
        $mysqli -> next_result();

        $nome = explode(" ", $usuario["nome"]);
        $nome = $nome[0];

        $foto = $usuario["foto"];
    }
    else {
      $foto = NULL;
    }

    $acao = $_GET["acao"];
    $valor = $_GET["valor"];

    if($acao == "cor") {
      $tabela = tintas_carregarPor_cor($mysqli, $valor);
    }
    else if($acao == "marca") {
      $tabela = tintas_carregarPor_marca($mysqli, $valor);
    }
    else {
      $tabela = tintas_carregar($mysqli);
    }

    $qtde_linhas = $tabela -> num_rows;
    $mysqli -> next_result();

    $marcas = tintas_carregar_marcas($mysqli);
    $mysqli -> next_result();
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
    <div class="row mb-2 justify-content-center"">
      <!-- Filtros -->
      <div class="col-md-2 filter-box">
        <h5>Filtrar</h5>
        <p class="text-secondary">Marcas</p>
        <div class="form-check">
          <input class="form-check-input" type="checkbox" id="saci" />
          <label class="form-check-label" for="saci">Saci</label>
        </div>
        <div class="form-check">
          <input class="form-check-input" type="checkbox" id="coral" />
          <label class="form-check-label" for="coral">Coral</label>
        </div>
        <div class="form-check">
          <input class="form-check-input" type="checkbox" id="suvinil" />
          <label class="form-check-label" for="suvinil">Suvinil</label>
        </div>
        <div class="form-check">
          <input class="form-check-input" type="checkbox" id="coralar" />
          <label class="form-check-label" for="coralar">Coralar</label>
        </div>
        <p class="text-secondary">Cores</p>
        <div class="form-check">
          <input class="form-check-input" type="checkbox" id="vermelho" />
          <label class="form-check-label" for="vermelho">Vermelho</label>
        </div>
        <div class="form-check">
          <input class="form-check-input" type="checkbox" id="verde" />
          <label class="form-check-label" for="verde">Verde</label>
        </div>
        <button type="button" class="btn-aplicar">Aplicar</button>
      </div>

      <!-- Titulo, resultado, ordenar por, cards, paginação -->
      <div class="options col-md-9">
        <div class="d-flex justify-content-between align-items-center mb-3">
          <div>
            <!-- Titulo -->
            <h3 class="title fw-bold">Tintas disponíveis</h3>

            <!-- Resultado (Some no mobile)-->
            <span class="result">Foram encontrados 18 resultados para sua pesquisa</span>

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
                  <h5>Filtrar</h5>
                  <p class="text-secondary">Marcas</p>
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="saci" />
                    <label class="form-check-label" for="saci">Saci</label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="coral" />
                    <label class="form-check-label" for="coral">Coral</label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="suvinil" />
                    <label class="form-check-label" for="suvinil">Suvinil</label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="coralar" />
                    <label class="form-check-label" for="coralar">Coralar</label>
                  </div>
                  <p class="text-secondary">Cores</p>
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="vermelho" />
                    <label class="form-check-label" for="vermelho">Vermelho</label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="verde" />
                    <label class="form-check-label" for="verde">Verde</label>
                  </div>
                  <button type="button" class="btn-aplicar">Aplicar</button>
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
          <script>
            const cards = [];
            for (let i = 0; i < 18; i++) {
              cards.push(`
                <div class="col">
                  <div class="card p-3">
                    <img src="img-bd/68857b890dc86.jpg" alt="Tinta" class="img-fluid mb-2" />
                    <h6 class="product-title">Tinta azul - Saci</h6>
                    <p class="mb-1"><strong>Quantidade disponível:</strong> 3.5L</p>
                    <p class="mb-2"><strong>Data de validade:</strong> 10/12/2024</p>
                    <button class="btn btn-interesse">Tenho Interesse</button>
                  </div>
                </div>
              `);
            }
            document.write(cards.join(""));
          </script>
        </div>

        <!-- Paginação -->
        <nav class="mt-4 d-flex justify-content-center">
          <ul class="pagination">
            <li class="page-item"><a class="page-link" href="#">&#x3C;</a></li>
            <li class="page-item active"><a class="page-link" href="#">1</a></li>
            <li class="page-item"><a class="page-link" href="#">2</a></li>
            <li class="page-item"><a class="page-link" href="#">3</a></li>
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