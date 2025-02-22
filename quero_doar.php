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
    <link rel="stylesheet" href="./css/main.css">
    <link rel="stylesheet" href="./css/index.css">
    <link rel="stylesheet" href="./css/navbarLogado.css">
    <link rel="stylesheet" href="./css/navbarDeslog.css">
    <link rel="stylesheet" href="./css/quero-doar.css">

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
        .foto-perfil {
            border-radius: 30px;
        }
    </style>
</head>

<body>
    <?php include 'navbar.php'; ?>
    
    <div class="container pagina">
        <div class="row" style="margin-top: 20px; display: flex; justify-content: center;">
            <div class="col-md-5 col-info">

                <div class="col-md-12" style="display: flex;">
                    <img class="img-tittle" src="imagens/1379778.png" alt="icone de balde de tinta"
                        style="margin-right: 10px;">
                    <h3 style="margin-bottom: 20px;">LOCAIS DE DOAÇÃO: </h3>
                </div>

                <div class="row row-bg-1">
                    <div class="col-md-12">
                        <h3>Saci tintas</h3>
                        <h4>Vila Angelica, Jundiaí</h4>
                        <h5>Horários de funcionamento: </h5>

                        <select name="horarios_funcionamento" id="horarios_funcionamento">
                            <option value="dia1">Segunda: 07:30h - 18:00h</option>
                            <option value="dia2">Terça-feira: 07:30h - 18:00h</option>
                            <option value="dia3">Quarta-feira: 07:30h - 18:00h</option>
                            <option value="dia4">Quinta-feira: 07:30h - 18:00h</option>
                            <option value="dia5">Sexta-feira: 07:30h - 18:00h</option>
                            <option value="dia6">Sábado: 08:00h - 13:00h</option>
                            <option value="dia7">Domingo: fechado</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <img class="icone-localizacao" src="icones/mundo.png" alt="logo do site">
                        <a class="a-links" href="https://www.sacitintas.com.br/">Site</a>
                    </div>
                    <div class="col-md-4">
                        <img class="icone-site" src="icones/localizacao.png" alt="logo de rotas">
                        <a class="a-links"
                            onclick="window.open('https://www.google.com/maps/dir//Saci+Tintas+-+Rua+Cica,+90+-+Vila+Angelica,+Jundia%C3%AD+-+SP,+13206-765/data=!4m6!4m5!1m1!4e2!1m2!1m1!1s0x94cf26c7b0f14c53:0x98ec6dee45664d39?sa=X&ved=1t:57443&ictx=111')">Rotas</a>
                    </div>
                </div>
                <div class="row row-bg-2">
                    <div class="col-md-12">
                        <h3>Saci tintas</h3>
                        <h4>Centro, Jundiaí</h4>
                        <h5>Horários de funcionamento: </h5>

                        <select name="horarios_funcionamento" id="horarios_funcionamento">
                            <option value="dia1">Segunda: 07:30h - 18:00h</option>
                            <option value="dia2">Terça-feira: 07:30h - 18:00h</option>
                            <option value="dia3">Quarta-feira: 07:30h - 18:00h</option>
                            <option value="dia4">Quinta-feira: 07:30h - 18:00h</option>
                            <option value="dia5">Sexta-feira: 07:30h - 18:00h</option>
                            <option value="dia6">Sábado: 08:00h - 13:00h</option>
                            <option value="dia7">Domingo: fechado</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <img class="icone-localizacao" src="icones/mundo.png" alt="logo do site">
                        <a class="a-links" href="https://www.sacitintas.com.br/">Site</a>
                    </div>
                    <div class="col-md-4">
                        <img class="icone-site" src="icones/localizacao.png" alt="logo de rotas">
                        <a class="a-links"
                            onclick="window.open('https://www.google.com/maps/dir//Saci+Tintas+-+R.+Petronilha+Antunes,+253%2F255+-+Centro,+Jundia%C3%AD+-+SP,+13201-080/data=!4m6!4m5!1m1!4e2!1m2!1m1!1s0x94cf2693fea51011:0xdaf8d49999f355ef?sa=X&ved=1t:57443&ictx=111')">Rotas</a>
                    </div>
                </div>
                <div class="row row-bg-3">
                    <div class="col-md-12">
                        <h3>Saci tintas</h3>
                        <h4>Vila Arens, Jundiaí</h4>
                        <h5>Horários de funcionamento: </h5>

                        <select name="horarios_funcionamento" id="horarios_funcionamento">
                            <option value="dia1">Segunda: 07:30h - 18:00h</option>
                            <option value="dia2">Terça-feira: 07:30h - 18:00h</option>
                            <option value="dia3">Quarta-feira: 07:30h - 18:00h</option>
                            <option value="dia4">Quinta-feira: 07:30h - 18:00h</option>
                            <option value="dia5">Sexta-feira: 07:30h - 18:00h</option>
                            <option value="dia6">Sábado: 08:00h - 13:00h</option>
                            <option value="dia7">Domingo: fechado</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <img class="icone-localizacao" src="icones/mundo.png" alt="logo do site">
                        <a class="a-links" href="https://www.sacitintas.com.br/">Site</a>
                    </div>
                    <div class="col-md-4">
                        <img class="icone-site" src="icones/localizacao.png" alt="logo de rotas">
                        <a class="a-links"
                            onclick="window.open('https://www.google.com/maps/dir//Saci+Tintas+-+R.+Jos%C3%A9+do+Patroc%C3%ADnio,+573+-+Vila+Arens,+Jundia%C3%AD+-+SP,+13202-460/data=!4m6!4m5!1m1!4e2!1m2!1m1!1s0x94cf26c19974c451:0x96a99b2ace615e2f?sa=X&ved=1t:57443&ictx=111')">Rotas</a>
                    </div>
                </div>
                <div class="row row-bg-4">
                    <div class="col-md-12">
                        <h3>Fatec Jundiaí</h3>
                        <h4>Avenida União Ferroviários, Jundiaí</h4>
                        <h5>Horários de funcionamento: </h5>

                        <select name="horarios_funcionamento" id="horarios_funcionamento">
                            <option value="dia1">Segunda-feira: 09:00h - 17:00h</option>
                            <option value="dia2">Terça-feira: 09:00h - 17:00h</option>
                            <option value="dia3">Quarta-feira: 09:00h - 17:00h</option>
                            <option value="dia4">Quinta-feira: 09:00h - 17:00h</option>
                            <option value="dia5">Sexta-feira: 09:00h - 17:00h</option>
                            <option value="dia6">Sábado: fechado</option>
                            <option value="dia7">Domingo: fechado</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <img class="icone-localizacao" src="icones/mundo.png" alt="logo do site">
                        <a class="a-links" href="https://www.sacitintas.com.br/">Site</a>
                    </div>
                    <div class="col-md-4">
                        <img class="icone-site" src="icones/localizacao.png" alt="logo de rotas">
                        <a class="a-links"
                            onclick="window.open('https://www.google.com/maps/dir/-22.9638144,-47.1400448/horarios+de+funcionamento+fatec+jundiai/@-23.0604706,-47.1756072,11z/data=!3m1!4b1!4m9!4m8!1m1!4e1!1m5!1m1!1s0x94cf26f327da8701:0x14d9db18c6f7fd60!2m2!1d-46.8829765!2d-23.1814575?entry=ttu&g_ep=EgoyMDI0MTEwNi4wIKXMDSoASAFQAw%3D%3D')">Rotas</a>
                    </div>
                </div>

            </div>


            <div class="col-md-5 col-agendamentos">
                <h3 style="margin-bottom: 20px;">AGENDAMENTOS: </h3>
                <p class="font-20">Para realizar a entrega das tintas, é necessário marcar um horários disponível com a
                    equipe responsável pelo recebimento e verificação das tintas.
                    O horário de funcionamento do Banco de Tintas, localizado na Faculdade de Tecnologia de Jundiaí
                    Deputado Ary Fossen, é das 09:00h até as 18:00h, para mais informações, entre em contato:</p>
                <p class="font-20"><span class="text_purple">Telefone: </span> (11) 91234-5678</p>
                <p class="font-20"><span class="text_purple">Email: </span> email@email.com</p>
                <p class="font-20"><span class="text_purple">Responsável pelo banco de tintas: </span> (colocar nome do
                    adm)</p>

                <div class="col-md-12" style="display: flex;">
                    <h3 style="margin-bottom: 20px;">COMO POSSO DOAR AS TINTAS? </h3>
                </div>

                <p class="font-20-bold">As tintas devem possuir algumas restrições quanto ao processo de doação, veja a
                    seguir:</p>
                <p class="font-20">- Sua base deve ser água, se for uma tinta com outro tipo de componente não será
                    aceita.<br>- A tinta deve estar dentro do prazo de validade.<br>- A tinta deve estar em boas
                    condições de preservação.<br>- As especificaçõe da tinta devem ser legíveis.</p>
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
                            class="text_a_link text_purple" href="#">@fatecjd</a>
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