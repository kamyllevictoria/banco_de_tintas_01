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
    <link rel="stylesheet" href="./css/documentacao.css">

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
    
    <div class="content">
        <div class="documentation">
            <h2 id="doar">Doar</h2>
            <h5>Como doar?</h5>
            <p class="text">A tinta deve ser a base de água e não pode estar vencida</p>
            <p class="text">Você deve ir a um dos locais de doação listado abaixo</p>
            <ul>
                <li>Fatec Jundiaí</li>
                <li>Saci tintas</li>
                <li>Saci tintas</li>
                <li>Saci tintas</li>
            </ul>
            
            <h2 id="pedido">Pedido</h2>
            <h5>Como posso solicitar uma tinta?</h5>
            <p class="text">Dentre as cores disponiveis, escolha uma e clique no botão "Tenho interesse".</p>
            <p class="text">Insira a quantidade em litros que deseja e confirme. Feito isso, o seu pedido foi realizdo com sucesso!</p>
            <p class="text">Agora, basta esperar que um de nossos atendentes altere o status do seu pedido.</p>

            <h5>Como vejo o status do meu pedido?</h5>
            <p class="text">Para visualisar os seus pedidos, basta clicar sobre a sua foto de perfil, selecionar a opção "Meus dados" e em seguida, navegar para a aba "Meus pedidos".</p>
            <p class="text">Nela você encontra todas as informações da tinta que você solicitou, incluindo o status.</p>

            <h2 id="agendamento">Agendamento</h2>
            <h5>Onde posso coletar a tinta?</h5>
            <p class="text">A coleta de tintas solicitadas só acontece na Fatec Jundiaí, nunca nas lojas Saci Tintas.</p>

            <h5>E se eu não conseguir ir na data e hora agendada?</h5>
            <p class="text">Essa eu ninguem sabe te responder, dá seus pulos.</p>
            <h2 id="lista">Lista de desejos</h2>
            <p class="text">A Lista de Desejos possui o objetivo de te informar quando uma tinta indisponivel voltar ao estoque, sendo assim, só é possivel incluir tintas que não estão disponiveis.</p>
            <h2 id="contato">Contato</h2>
            <p>Caso você ainda esteja com dúvidas, entre em contato conosco, através do seguintes canais:</p>
            <ul>
                <li>Instagram: @fatecjd</li>
                <li>Instagram: @bancodetintasfatecjdi</li>
                <li>E-mail: bancodetintas@gmail.com</li>
                <li>Whatsapp: (11) 9 4002-8922</li>
            </ul>
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