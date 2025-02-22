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
  <?php include 'navbar.php'; ?>
  
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
            <?php if($tabela): ?>
              <?php
                $cont = 1;
                $page = $_GET["page"];
                $pageCont = 1;
                $coresDisponiveis = "";
                $coresIndisponiveis = "";
              ?>
              <?php while($linha = mysqli_fetch_array($tabela)): ?>
                <?php if(floatval($linha["volume"]) > 0): ?>
                  <?php
                    $pageCont++;
                    $coresDisponiveis .= ";" . $linha["cor"];
                    $dataValidade = explode('-', $linha["dataValidade"]);
                  ?>
                  <?php if($page == 1): ?>
                    <?php if($cont >= $page && $cont <= $page + 3): ?>
                      <div class="col-md-6 <?= $cont % 2 == 0 ? '' : 'd-flex justify-content-end' ?>">
                        <div class="product-card p-3" style="width:80%">
                          <img src="<?= $linha['imagem']; ?>" alt="Tinta <?= $linha['cor']; ?>" style="height:230px">
                          <h5 class="mt-3">Tinta <?= $linha['cor']; ?></h5>
                          <p>Quantidade disponível: <?= $linha['volume']; ?>L</p>
                          <p>Data de validade: <?= $dataValidade[2]; ?>/<?= $dataValidade[1]; ?>/<?= $dataValidade[0]; ?></p>
                          <?php if($_SESSION['ADM'] == FALSE && $_SESSION['USUARIO'] != FALSE): ?>
                            <button onclick="modal('<?= $linha['identificacao']; ?>')" class="btn btn-green btn_card">Tenho Interesse</button>
                            </div>
                          </div>
                          <div id="modalBackground<?= $linha['identificacao']; ?>" class="modal-background"></div>
                          <div id="modalContainer<?= $linha['identificacao']; ?>" class="container-green">
                            <div class="fechar-modal" onclick="fecharModal('<?= $linha['identificacao']; ?>')">
                              <img src="imagens/fechar.png" width="50px">
                            </div>
                            <h4 class="text_purple pad_bottom_20">Informe a quantidade da tinta desejada:</h4>
                            <form action="config/pedidos_config.php" method="post">
                              <input type="hidden" name="fazer-pedido">
                              <input type="hidden" name="identificacao" value="<?= $linha['identificacao']; ?>">
                              <div class="form-group pad_bottom_20">
                                <label for="volumeLitros" class="text_purple">Volume em Litros:</label>
                                <input name="volume<?= $linha['identificacao']; ?>" type="number" step=".01" class="form-control input-small mb-2" id="volumeLitros" placeholder="Volume em litros">
                              </div>
                              <button class="btn btn-purple-editar" id="btnSalvar<?= $linha['identificacao']; ?>">Solicitar Tinta</button>
                            </form>
                          </div>
                        <?php else: ?>
                          </div>
                        </div>
                      <?php endif; ?>
                    <?php endif; ?>
                  <?php endif; ?>
                  <?php $cont++; ?>
                <?php else: $coresIndisponiveis .= ";".$linha['cor']; ?>
                <?php endif; ?>
              <?php endwhile; ?>
              <?php if($_SESSION["ADM"] == FALSE && $_SESSION["USUARIO"] != FALSE): ?>
                <?php
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
                  }
                ?>
                <?php while($linha = mysqli_fetch_array($tabela)): ?>
                  <?php if($temLista && $cont2 == 1): ?>
                    <?php if($page == 1 && $cont >= $page && $cont <= $page + 3): ?>
                      <?php if($cont % 2 == 0): ?>
                        <div class="col-md-6">
                      <?php else:?>
                        <div class="col-md-6 d-flex justify-content-end">
                      <?php endif; ?>

                      <div class="product-card p-3" style="width:80%">
                        <img src="img-bd/padrao.jpg" style="height:230px; filter:grayscale(100%);">
                        <h5 class="mt-3">Tinta <?= $cor; ?></h5>
                        <p>Indisponível</p>
                        <a href="usuario.php">
                          <button class="btn btn-secondary btn_card">
                            <img src="imagens/coracao.png" width="20px" style="margin-right:10px;">
                            Salvo
                          </button>
                        </a>
                      </div>
                      </div>
                    <?php elseif($page > 1 && $cont >= $page + 3 && $cont <= $page + 6): ?>
                      <?php if($cont % 2 == 0): ?>
                        <div class="col-md-6">
                      <?php else: ?>
                        <div class="col-md-6 d-flex justify-content-end">
                      <?php endif; ?>

                      <div class="product-card p-3" style="width:80%">
                        <img src="img-bd/padrao.jpg" style="height:230px; filter:grayscale(100%);">
                        <h5 class="mt-3">Tinta <?= $cor; ?></h5>
                        <p>Indisponível</p>
                        <a href="usuario.php">
                          <button class="btn btn-secondary btn_card">
                            <img src="imagens/coracao.png" width="20px" style="margin-right:10px;">
                            Salvo
                          </button>
                        </a>
                      </div>
                      </div>
                    <?php endif; ?>
                    <?php $cont2++; ?>
                  <?php else: ?>
                    <?php if($cont == 1):?>
                      <?php if($page == 1 && $cont >= $page && $cont <= $page + 3): ?>
                        <?php if($cont % 2 == 0):?>
                          <div class="col-md-6">
                        <?php else: ?>
                          <div class="col-md-6 d-flex justify-content-end">
                        <?php endif; ?>

                        <div class="product-card p-3" style="width:80%">
                          <img src="img-bd/padrao.jpg" style="height:230px; filter:grayscale(100%);">
                          <h5 class="mt-3">Tinta <?= $cor; ?></h5>
                          <p>Indisponível</p>
                          <form action="config/pedidos_config.php" method="post">
                            <input type="hidden" name="lista-desejos">
                            <input type="hidden" name="identificacao" value="'.$linha["identificacao"].'">';
                            <button type="submit" class="btn btn-secondary btn_card">
                              <img src="imagens/coracao-vazio.png" width="20px" style="margin-right:10px;">
                              Salvar
                            </button>
                          </form>
                        </div>
                        </div>

                      <?php elseif($page > 1 && $cont >= $page + 3 && $cont <= $page + 6): ?>
                        <?php if($cont % 2 == 0):?>
                          <div class="col-md-6">
                        <?php else: ?>
                          <div class="col-md-6 d-flex justify-content-end">
                        <?php endif; ?>

                        <div class="product-card p-3" style="width:80%">
                          <img src="img-bd/padrao.jpg" style="height:230px; filter:grayscale(100%);">
                          <h5 class="mt-3">Tinta <?= $cor; ?></h5>
                          <p>Indisponível</p>
                          <form action="config/pedidos_config.php" method="post">
                            <input type="hidden" name="lista-desejos">
                            <input type="hidden" name="identificacao" value="<?= $linha["identificacao"]; ?>">
                            <button type="submit" class="btn btn-secondary btn_card">
                              <img src="imagens/coracao-vazio.png" width="20px" style="margin-right:10px;">
                              Salvar
                            </button>
                          </form>
                        </div>
                        </div>

                        <?php $cont2++; ?>
                      <?php endif; ?>
                    <?php endif; ?>
                  <?php endif; ?>
                  <?php $cont2++; ?>
                <?php endwhile; ?>
              <?php endif; ?>
            <?php endif; ?>
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
            ?>
            <?php if($qtde_linhas / 4 > 1): ?>
              <?php if($pageAnte == 0): ?>
                <li class="page-item disabled">
                  <a class="page-link" href="#" tabindex="-1" aria-disabled="true">&laquo;</a>
                </li>
              <?php else: ?>
                <li class="page-item">
                  <a class="page-link" href="?acao=<?= $acao; ?>&valor=<?= $valor; ?>&page=<?= $pageAnte; ?>">&raquo;</a>
                </li>
              <?php endif; ?>

              <?php while($linha = mysqli_fetch_array($tabela)): ?>
                <?php if($cont2 % 4 == 0): ?>
                  <?php if($cont == $page): ?>
                    <li id="page<?= $cont; ?>" class="page-item active">
                      <a class="page-link" href="?acao=<?= $acao; ?>&valor=<?= $valor; ?>&page=<?= $cont; ?>"><?= $cont; ?></a>
                    </li>
                  <?php else: ?>
                    <li id="page<?= $cont; ?>" class="page-item">
                      <a class="page-link" href="?acao=<?= $acao; ?>&valor=<?= $valor; ?>&page=<?= $cont; ?>"><?= $cont; ?></a>
                  </li>
                  <?php endif; ?>
                  <?php $cont++; ?>
                <?php endif; ?>
                <?php $cont++; ?>
              <?php endwhile; ?>
              <?php if($pageProx <= $qtde_linhas / 4): ?>
                <li class="page-item">
                  <a class="page-link" href="?acao=<?= $acao; ?>&valor=<?= $valor; ?>&page=<?= $pageProx; ?>">&raquo;</a>
                </li>
              <?php else: ?>
                <li class="page-item disabled">
                  <a class="page-link" href="#">&raquo;</a>
                </li>
              <?php endif; ?>
            <?php endif; ?>
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