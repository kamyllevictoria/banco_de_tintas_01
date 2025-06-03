<?php
    session_start();

    if(isset($_SESSION["mensagem-fazer-pedido"])) {
        $mensagem = $_SESSION["mensagem-fazer-pedido"];

        if($mensagem == "Pedido efetuado.") {
            $sucesso = true;
        }
        else {
            $sucesso = false;
        }

        unset($_SESSION["mensagem-fazer-pedido"]);
    }
    else {
        $mensagem = null;
    }

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
    $tabela = mysqli_query($conexao, "CALL tintas_carregar()");
    mysqli_close($conexao);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Banco de Tintas | Fatec-JDI</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- CSS -->
    <link rel="stylesheet" href="css/index.css">
    <!-- <link rel="stylesheet" href="css/main.css"> -->
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
    
    <section class="pagina">
        <div class="container">
            <?php if($mensagem): ?>
                <div class="row mt-2">
                    <div class="col-12">
                        <?php if($sucesso): ?>
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>Sucesso!</strong>
                                <?= $mensagem; ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php else: ?>
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong>Dados inválidos!</strong>
                                <?= $mensagem; ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endif; ?>
            
            <h2 class="title text_green padding_20">BANCO DE TINTAS</h2>
            <div class="row">
                <div class="col-md-6">
                    <img src="imagens/img2.avif" alt="imagem 1" class="img-fluid-custom">
                </div>
                <div class="col-md-6">
                    <p class="text_justify">As tintas são substâncias amplamente utilizadas em diversas áreas, como
                        arte, construção civil, design e indústria, sendo essenciais tanto para a decoração quanto para
                        a proteção de superfícies. Sua composição básica inclui pigmentos, responsáveis por proporcionar
                        a cor, e um meio líquido, conhecido como veículo, que permite sua aplicação. Após serem
                        aplicadas, o veículo evapora ou seca, deixando o pigmento fixo na superfície. <br>

                        <br>Existem diferentes tipos de tintas, cada uma adequada para uma finalidade específica. As
                        tintas à base de água, por exemplo, são muito comuns em pinturas domésticas e artísticas devido
                        à sua facilidade de uso e à rápida secagem. Além disso, são menos tóxicas e mais fáceis de
                        limpar, o que as torna populares para ambientes internos. Em contrapartida, as tintas à base de
                        solvente, que utilizam substâncias químicas em sua composição, são mais resistentes e duráveis,
                        sendo ideais para áreas externas, embora tenham um odor mais forte e levem mais tempo para
                        secar.
                    </p>
                </div>
            </div>
        </div>
    </section>


    <section class="section_2">
        <div class="container">
            <h2 class="title text_white padding_20 text-center">TINTAS DISPONÍVEIS</h2>
            <div class="row justify-content-center">
                <?php $cont = 1; ?>
                <?php while($linha = mysqli_fetch_array($tabela)): ?>
                    <?php if(floatval($linha["volume"]) > 0 && $cont <= 4): ?>
                        <div class="col-sm-6 col-lg-3 col-12 mb-4 px-5 px-sm-2">
                            <div class="card mx-auto">
                                <img src="<?= $linha["imagem"]; ?>" class="card-img-top mx-auto d-block card_img" alt="Imagem do Card 4" style="height: 230px;">
                                <div class="card-body">
                                    <h5 class="card-title">Tinta <?= $linha["cor"]; ?></h5>
                                    <p class="card-text">Volume de <?= $linha["volume"]; ?>L</p>
                            <?php if($_SESSION["ADM"] == FALSE && $_SESSION["USUARIO"] != FALSE): ?>
                                <button onclick="modal('<?= $linha['identificacao']; ?>')" class="btn btn-green btn-interesse btn_card">Tenho Interesse</button>
                                </div>
                                </div>
                                </div>
                                <div id="modalBackground<?= $linha["identificacao"]; ?>" class="modal-background"></div>
                                <div id="modalContainer<?= $linha["identificacao"]; ?>" class="container-green teste-modal">
                                    <div class="fechar-modal" onclick="fecharModal('<?= $linha['identificacao']; ?>')">
                                        <img src="imagens/fechar.png" width="50px">
                                    </div>
                                    <h4 class="text_purple pad_bottom_20">Informe a quantidade da tinta desejada:</h4>
                                    <form action="php/pedidos_config.php" method="post">
                                        <input type="hidden" name="fazer-pedido">
                                        <input type="hidden" name="identificacao" value="<?= $linha["identificacao"]; ?>">
                                        <div class="form-group pad_bottom_20">
                                            <label for="volumeLitros" class="text_purple">Volume em Litros:</label>
                                            <input name="volume<?= $linha["identificacao"]; ?>" type="number" step=".01" class="form-control input-small mb-2" id="volumeLitros" placeholder="Volume em litros">
                                        </div>
                                        <button class="btn btn-solicitar" id="btnSalvar<?= $linha["identificacao"]; ?>">Solicitar Tinta</button>
                                    </form>
                                </div>
                            <?php else: ?>
                                </div>
                                </div>
                                </div>
                            <?php endif; ?>
                    <?php endif; ?>
                    <?php $cont++; ?>
                <?php endwhile; ?>
            </div>
            <div class="text-center">
                <a href='opcoes.php?acao=todos&valor=todos&page=1' class="text_a_link text_neon_green pad_top_20" style="display: inline-block;">Ver
                    mais opções</a>
            </div>
        </div>
    </section>

    <section class="section_3">
        <h2 class="title text_green pad_top_20 pad_bottom_20 text-center">PROJETO SOCIAL</h2>
        <div class="container">
            <div class="row justify-content-center">

                <div class="col-lg-3 col-md-6 col-12 mb-4">
                    <div class="card card_transparent mx-auto" style="max-width: 18rem;">
                        <img src="./icones/pincel.png" class="card-img-top mx-auto d-block card_img img-small"
                            alt="Imagem do Card 1">
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 col-12 mb-4">
                    <div class="card card_transparent mx-auto" style="max-width: 18rem;">
                        <img src="./icones/casa.png" class="card-img-top mx-auto d-block card_img img-small"
                            alt="Imagem do Card 2">
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 col-12 mb-4">
                    <div class="card card_transparent mx-auto" style="max-width: 18rem;">
                        <img src="./icones/balde_tinta.png" class="card-img-top mx-auto d-block card_img img-small"
                            alt="Imagem do Card 3">
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 col-12 mb-4">
                    <div class="card card_transparent mx-auto" style="max-width: 18rem;">
                        <img src="./icones/pessoa_balde.png" class="card-img-top mx-auto d-block card_img img-small"
                            alt="Imagem do Card 4">
                    </div>
                </div>

                <div class="col-12">
                    <p class="text_justify">As tintas são substâncias amplamente utilizadas em diversas áreas, como
                        arte, construção civil, design e indústria, sendo essenciais tanto para a decoração quanto para
                        a proteção de superfícies. Sua composição básica inclui pigmentos, responsáveis por proporcionar
                        a cor, e um meio líquido, conhecido como veículo, que permite sua aplicação. Após serem
                        aplicadas, o veículo evapora ou seca, deixando o pigmento fixo na superfície. <br>

                        <br>Existem diferentes tipos de tintas, cada uma adequada para uma finalidade específica. As
                        tintas à base de água, por exemplo, são muito comuns em pinturas domésticas e artísticas devido
                        à sua facilidade de uso e à rápida secagem. Além disso, são menos tóxicas e mais fáceis de
                        limpar, o que as torna populares para ambientes internos. Em contrapartida, as tintas à base de
                        solvente, que utilizam substâncias químicas em sua composição, são mais resistentes e duráveis,
                        sendo ideais para áreas externas, embora tenham um odor mais forte e levem mais tempo para
                        secar.
                    </p>
                </div>

            </div>
        </div>
    </section>

    <footer class="mt-5">
        <div class="container">
            <div class="row text-center">
                <div class="col-md-4 mb-4">
                    <img src="./icones/fatec_logo.png" alt="Logo" class="img-fluid" width="300px" height="50px">
                    <p class="text_justify">
                        <img src="./icones/insta.png" width="40px" height="40px" alt="logo instagram"> <a
                            class="text_a_link" href="https://www.instagram.com/fatecjd/">@fatecjd</a>
                    </p>

                    <p class="text_justify ">
                        <img src="./icones/insta.png" width="40px" height="40px" alt="logo instagram">
                        <a class="text_a_link" href="https://www.instagram.com/bancodetintasfatecjdi/">@bancodetintasfatecjdi</a>
                    </p>
                </div>

                <div class="col-md-4 mb-4">
                    <p class="text_justify text-principal-footer">Banco de tintas é uma iniciativa da FATEC Jundiaí!</p>
                    <p class="text-footer">
                        <a class="text_a_link"  href="./quero_doar.php">Quero doar</a>
                    </p>
                    <p class="text-footer">
                        <a class="text_a_link" href="./login.php">Login</a>
                    </p>
                    <p class="text-footer">
                        <a class="text_a_link" href="./cadastro.php">Cadastre-se</a>
                    </p>
                    <p class="text-footer">
                        <a class="text_a_link" href="#">Dúvidas</a>
                    </p>
                    <p class="text-footer">
                        <a class="text_a_link" href="#">Documentação</a>
                    </p>
                </div>
                
                <div class="col-md-4 mb-4">
                    <p class="text-principal-footer">Funcionamento</p>
                    <p class="text-footer">Segunda a sexta das 09:00 ate as 18:00</p>
                    <p class="text-footer">Email: f114.secretaria@fatec.sp.gov.br</p>
                    <p class="text-footer">Telefone: (11) 4522-7549</p>



                </div>
            </div>
        </div>
    </footer>

    
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

        function fecharModal(id) {
            document.getElementById("modalBackground" + id).style.display = "none";
            document.getElementById("modalContainer" + id).style.display = "none";
        }

    </script>
</body>


</html>