<?php
session_start();

if (isset($_SESSION["mensagem-alterar-tinta"])) {
    $mensagem = $_SESSION["mensagem-alterar-tinta"];

    if ($mensagem == "Tinta alterada.") {
        $sucesso = true;
    } else {
        $sucesso = false;
    }

    unset($_SESSION["mensagem-alterar-tinta"]);
} else {
    $mensagem = null;
}

if (!(isset($_SESSION["USUARIO"]))) {
    $_SESSION["USUARIO"] = NULL;
}

if (!(isset($_SESSION["ADM"]))) {
    $_SESSION["ADM"] = NULL;
}

if ($_SESSION["ADM"] == FALSE && $_SESSION["ADM"] == NULL) {
    header('location: index.php');
}

$conexao = mysqli_connect("localhost", "root", "", "banco_tintas") or die("Falha na conexão");
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
    <link rel="stylesheet" href="./css/navbarLogado.css">
    <link rel="stylesheet" href="./css/catalogo.css">

    <!-- FontAwesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" rel="stylesheet">

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>

    <link rel="shortcut icon" href="imagens/Logo.png" type="image/x-icon">

</head>

<body>
    <?php include 'navbar.php'; ?>

    <section class="page">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-2 pb-3 col-12 sidebar">
                    <h4 class="menu_text">MENU</h4>
                    <ul class="nav flex-column">
                        <li class="nav-item pad_top_20">
                            <a class="nav-link text-dark link_bg_adm" href="pedidos.php">Pedidos</a>
                        </li>
                        <li class="nav-item pad_top_20">
                            <a class="nav-link text-dark link_bg_adm" href="cadastrar_tinta.php">Cadastrar tinta</a>
                        </li>

                        <li class="nav-item pad_top_20">
                            <a class="nav-link text-dark link_bg_adm" href="catalogo.php">Catálogo</a>
                        </li>
                        <li class="nav-item pad_top_20">
                            <a class="nav-link text-dark link_bg_adm" href="lixeira.php">Lixeira</a>
                        </li>
                    </ul>
                </div>
                <div class="col-lg-10 col-12 main-content">
                    <div class="top-actions">
                        <button class="btn delete-btn" data-bs-toggle="modal"
                            data-bs-target="#modalExcluirSelecionadas">
                            Excluir selecionadas
                        </button>

                        <div class="search-wrapper pesquisar-catalogo">
                            <span class="search-icon2">
                                <i class="fa fa-search"></i>
                            </span>
                            <form id="form-pesquisa" action="config/tintas_config.php" method="POST">
                                <input type="hidden" name="busca" value="1">
                                <input id="Pesquisa" class="form-control form-control-custom2" type="search"
                                    placeholder="" aria-label="Buscar" name="pesquisa">
                            </form>
                        </div>
                    </div>
                    <div class="accordion" id="accordionTintas">

                        <!-- ============ CARD 1 ============ -->
                        <div class="d-flex align-items-start mb-3">

                            <!-- CHECKBOX FORA -->
                            <div class="pt-3 me-2">
                                <input type="checkbox" class="form-check-input checkbox-externo">
                            </div>

                            <!-- ACCORDION -->
                            <div class="accordion-item paint-card flex-grow-1">

                                <h2 class="accordion-header">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#card1">

                                        <span class="card-title me-3">#1 Tinta Laranja</span>

                                        <div class="acoes-icons">
                                            <span class="icon-action" data-bs-toggle="modal"
                                                data-bs-target="#modalEditar">
                                                <i class="fa-solid fa-pencil"></i>
                                            </span>
                                            <span class="icon-action" data-bs-toggle="modal"
                                                data-bs-target="#modalExcluir">
                                                <i class="fa-solid fa-trash-can"></i>
                                            </span>
                                        </div>

                                    </button>
                                </h2>

                                <div id="card1" class="accordion-collapse collapse" data-bs-parent="#accordionTintas">
                                    <div class="accordion-body card-body">
                                        <div class="product-info">
                                            <div class="product-image">
                                                <img src="./imagens/img14.jpg">
                                            </div>

                                            <div class="product-details">
                                                <div class="detail-row">
                                                    <span class="detail-label">Quantidade disponível:</span>
                                                    <span class="detail-value">3.5L</span>
                                                </div>

                                                <div class="detail-row">
                                                    <span class="detail-label">Data de validade:</span>
                                                    <span class="detail-value">27/06/2025</span>
                                                </div>
                                                <div class="detail-row">
                                                    <span class="detail-label">Data de recebimento:</span>
                                                    <span class="detail-value">27/03/2025</span>
                                                </div>

                                                <div class="detail-row">
                                                    <span class="detail-label">Marca:</span>
                                                    <span class="detail-value">Saci</span>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <!-- ============ CARD 2 ============ -->
                        <div class="d-flex align-items-start mb-3">

                            <div class="pt-3 me-2">
                                <input type="checkbox" class="form-check-input checkbox-externo">
                            </div>

                            <!-- ACCORDION -->
                            <div class="accordion-item paint-card flex-grow-1">

                                <h2 class="accordion-header">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#card2">

                                        <span class="card-title me-3">#2 Tinta Preta</span>

                                        <div class="acoes-icons">
                                            <span class="icon-action" data-bs-toggle="modal"
                                                data-bs-target="#modalEditar">
                                                <i class="fa-solid fa-pencil"></i>
                                            </span>

                                            <span class="icon-action">
                                                <i class="fa-solid fa-trash-can"></i>
                                            </span>
                                        </div>

                                    </button>
                                </h2>

                                <div id="card2" class="accordion-collapse collapse" data-bs-parent="#accordionTintas">
                                    <div class="accordion-body card-body">
                                        <div class="product-info">
                                            <div class="product-image">
                                                <img src="./imagens/img12.jpg">
                                            </div>

                                            <div class="product-details">
                                                <div class="detail-row">
                                                    <span class="detail-label">Quantidade disponível:</span>
                                                    <span class="detail-value">3.5L</span>
                                                </div>

                                                <div class="detail-row">
                                                    <span class="detail-label">Data de validade:</span>
                                                    <span class="detail-value">27/06/2025</span>
                                                </div>
                                                <div class="detail-row">
                                                    <span class="detail-label">Data de recebimento:</span>
                                                    <span class="detail-value">27/03/2025</span>
                                                </div>

                                                <div class="detail-row">
                                                    <span class="detail-label">Marca:</span>
                                                    <span class="detail-value">Saci</span>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </section>

    <!-- MODAL EDITAR TINTA -->
    <div class="modal fade" id="modalEditar" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-lg">

            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title text_purple">Editar Tinta</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <form action="config/tintas_config.php" method="POST" enctype="multipart/form-data">
                    <div class="modal-body">
                        <input type="hidden" name="editar_tinta" value="1">
                        <input type="hidden" name="id_tinta" value="1">

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Quantidade (L)</label>
                                <input type="text" class="form-control" name="quantidade" value="3.5">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Marca</label>
                                <input type="text" class="form-control" name="marca" value="Saci">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Data de recebimento</label>
                                <input type="date" class="form-control" name="data_recebimento" value="2025-03-27">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Data de validade</label>
                                <input type="date" class="form-control" name="data_validade" value="2025-06-27">
                            </div>

                            <div class="col-12 mb-3">
                                <label class="form-label">Imagem</label>
                                <input type="file" class="form-control" name="imagem">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-cancel" data-bs-dismiss="modal">
                                    Cancelar
                                </button>

                                <button type="submit" class="btn btn-purple">
                                    Salvar alterações
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- MODAL DE EXCLUIR SELECIONADAS-->
    <div class="modal fade" id="modalExcluirSelecionadas" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title text_purple">Confirmar exclusão</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    Tem certeza que deseja excluir as tintas selecionadas?
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-cancel" data-bs-dismiss="modal">
                        Cancelar
                    </button>

                    <button type="submit" class="btn btn-purple">
                        Sim, excluir
                    </button>
                </div>

            </div>
        </div>
    </div>

    <div class="modal fade" id="modalExcluir" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title text_purple">Confirmar exclusão</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    Tem certeza que deseja excluir essa tinta?
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-cancel" data-bs-dismiss="modal">
                        Cancelar
                    </button>

                    <button type="submit" class="btn btn-purple">
                        Sim, excluir
                    </button>
                </div>

            </div>
        </div>
    </div>

    <!-- Java Script -->
    <script src="js/scripts.js" defer></script>
</body>

</html>