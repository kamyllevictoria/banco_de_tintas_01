<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Banco de Tintas | Quero Doar</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- CSS -->
    <link rel="stylesheet" href="./css/navbarLogado.css">
    <link rel="stylesheet" href="./css/navbarDeslog.css">
    <link rel="stylesheet" href="./css/ajuda.css">

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
    <?php include './navbar.php'; ?>
    
    <div class="container-list-group">
        
        <div>
            <h2>Como podemos te ajudar?</h2>
            <div class="list-group">
                <a href="#" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center">
                        <div class="icon-wrapper">
                            <i class="fa-2x fa-solid fa-fill"></i>
                        </div>
                        <div>
                            <h6 class="mb-1">Doar</h6>
                            <small class="text-muted">Como doar tinta</small>
                        </div>
                    </div>
                    <i class="fa-solid fa-chevron-right"></i>
                </a>

                <a href="#" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center">
                        <div class="icon-wrapper">
                            <i class="fa-2x fa-solid fa-receipt"></i>
                        </div>
                        <div>
                            <h6 class="mb-1">Pedido</h6>
                            <small class="text-muted">Fiz um pedido e agora?</small>
                        </div>
                    </div>
                    <i class="fa-solid fa-chevron-right"></i>
                </a>

                <a href="#" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center">
                        <div class="icon-wrapper">
                            <i class="fa-2x fa-regular fa-calendar-days"></i>
                        </div>
                        <div>
                            <h6 class="mb-1">Agendamento</h6>
                            <small class="text-muted">Não consigo ir no dia e hora agendado</small>
                        </div>
                    </div>
                    <i class="fa-solid fa-chevron-right"></i>
                </a>

                <a href="#" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center">
                        <div class="icon-wrapper">
                            <i class="fa-2x fa-solid fa-heart"></i>
                        </div>
                        <div>
                            <h6 class="mb-1">Lista de desejos</h6>
                            <small class="text-muted">Como funciona?</small>
                        </div>
                    </div>
                    <i class="fa-solid fa-chevron-right"></i>
                </a>
                <a href="#" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center">
                        <div class="icon-wrapper">
                            <i class="fa-2x fa-solid fa-phone"></i>
                        </div>
                        <div>
                            <h6 class="mb-1">Contato</h6>
                            <small class="text-muted">E-mail, Whatsapp e Instagram</small>
                        </div>
                    </div>
                    <i class="fa-solid fa-chevron-right"></i>
                </a>
            </div>

        </div>
        
    </div>

    <footer class="mt-5">
        <div class="container">
            <div class="row text-center">
                <div class="col-md-4 mb-4">
                    <p class="text_justify">Banco de tintas é uma iniciativa da FATEC Jundiaí!</p>
                    <p class="text_justify">
                        <img src="./icones/insta.png" width="50px" height="50px" alt="logo instagram"> <a
                            class="text_a_link text_purple" href="https://www.instagram.com/fatecjd/">@fatecjd</a>
                    </p>

                    <p class="text_justify">
                        <img src="./icones/insta.png" width="50px" height="50px" alt="logo instagram">
                        <a class="text_a_link text_purple" href="https://www.instagram.com/bancodetintasfatecjdi/">@bancodetintasfatecjdi</a>
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