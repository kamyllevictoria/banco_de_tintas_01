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
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <script src="js/scripts.js" defer></script>
    
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
                            <a class="nav-link text-dark link_bg_adm" href="pedidos.php">Pedidos a serem aprovados</a>
                        </li>
                        <li class="nav-item pad_top_20">
                            <a class="nav-link text-dark link_bg_adm" href="cadastrar_tinta.php">Cadastrar tinta</a>
                        </li>
                        <li class="nav-item pad_top_20">
                            <a class="nav-link text-dark link_bg_adm" href="catalogo.php">Catálogo</a>
                        </li>
                        <li class="nav-item pad_top_20">
                            <a class="nav-link text-dark link_bg_adm active" href="lixeira.php">Lixeira</a>
                        </li>
                    </ul>
                </div>
                <div class="col-lg-10 col-12 main-content">
                    <button class="btn restore-btn">
                        Restaurar selecionadas
                    </button>

                    <div class="paint-cards">
                        <!-- Card 1 -->
                        <div class="card paint-card">
                            <div class="card-header card-bg" onclick="toggleCard('card1')">
                                <div class="d-flex align-items-center">
                                    <input type="checkbox" class="form-check-input checkbox-custom" onclick="event.stopPropagation()">
                                    <h6 class="card-title">#1 Tinta Laranja</h6>
                                </div>
                                <i class="fas fa-chevron-down toggle-icon" id="icon1"></i>
                            </div>
                            <div class="card-body hidden" id="card1">
                                <div class="product-info">
                                    <div class="product-image">
                                        <img src="/placeholder.svg?height=120&width=120" alt="Tinta Laranja">
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
                                            <span class="detail-value">12/04/2025</span>
                                        </div>
                                        <div class="detail-row">
                                            <span class="detail-label">Marca:</span>
                                            <span class="detail-value">Saci</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Card 2 -->
                        <div class="card paint-card">
                            <div class="card-header" onclick="toggleCard('card2')">
                                <div class="d-flex align-items-center">
                                    <input type="checkbox" class="form-check-input checkbox-custom" onclick="event.stopPropagation()">
                                    <h6 class="card-title">#2 Tinta Laranja</h6>
                                </div>
                                <i class="fas fa-chevron-down toggle-icon rotated" id="icon2"></i>
                            </div>
                            <div class="card-body" id="card2">
                                <div class="product-info">
                                    <div class="product-image">
                                        <img src="/placeholder.svg?height=120&width=120" alt="Tinta Laranja">
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
                                            <span class="detail-value">12/04/2025</span>
                                        </div>
                                        <div class="detail-row">
                                            <span class="detail-label">Data de validade:</span>
                                            <span class="detail-value">27/06/2025</span>
                                        </div>
                                        <div class="detail-row">
                                            <span class="detail-label">Marca:</span>
                                            <span class="detail-value">Saci</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Card 3 -->
                        <div class="card paint-card">
                            <div class="card-header" onclick="toggleCard('card3')">
                                <div class="d-flex align-items-center">
                                    <input type="checkbox" class="form-check-input checkbox-custom" onclick="event.stopPropagation()">
                                    <h6 class="card-title">#3 Tinta azul</h6>
                                </div>
                                <i class="fas fa-chevron-down toggle-icon" id="icon3"></i>
                            </div>
                            <div class="card-body hidden" id="card3">
                                <div class="product-info">
                                    <div class="product-image">
                                        <img src="/placeholder.svg?height=120&width=120" alt="Tinta Azul">
                                    </div>
                                    <div class="product-details">
                                        <div class="detail-row">
                                            <span class="detail-label">Quantidade disponível:</span>
                                            <span class="detail-value">2.8L</span>
                                        </div>
                                        <div class="detail-row">
                                            <span class="detail-label">Data de validade:</span>
                                            <span class="detail-value">15/08/2025</span>
                                        </div>
                                        <div class="detail-row">
                                            <span class="detail-label">Data de recebimento:</span>
                                            <span class="detail-value">20/03/2025</span>
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
    </section>

    <script>
        function toggleCard(cardId) {
            const cardBody = document.getElementById(cardId);
            const icon = document.getElementById('icon' + cardId.slice(-1));
            
            if (cardBody.classList.contains('hidden')) {
                cardBody.classList.remove('hidden');
                icon.classList.add('rotated');
            } else {
                cardBody.classList.add('hidden');
                icon.classList.remove('rotated');
            }
        }
    </script>
</body>
</html>