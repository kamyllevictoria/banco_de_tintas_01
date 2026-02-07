<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bem vindo | Central Banco de Tintas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <link rel="stylesheet" href="./css/navbarLogado.css">
    <link rel="stylesheet" href="./css/lixeira.css">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" rel="stylesheet">
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
    <section class="page">
        <?php include 'navbar.php'; ?>
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
                    <button class="btn restore-btn" data-bs-toggle="modal" data-bs-target="#modalRestaurarSelecionadas">
                        Restaurar selecionadas
                    </button>
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

    <!-- MODAL DE RESTAURAR SELECIONADAS-->
    <div class="modal fade" id="modalRestaurarSelecionadas" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title text-green">Confirmar restauração</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    Tem certeza que deseja restaurar as tintas selecionadas?
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-cancel" data-bs-dismiss="modal">
                        Cancelar
                    </button>

                    <button type="submit" class="btn btn-green">
                        Sim, restaurar
                    </button>
                </div>

            </div>
        </div>
    </div>
    <script src="js/scripts.js" defer></script>
</body>

</html>