<?php
    session_start();
    
    if(isset($_SESSION["mensagem-alterar-tinta"])) {
        $mensagem = $_SESSION["mensagem-alterar-tinta"];

        if($mensagem == "Tinta alterada.") {
            $sucesso = true;
        }
        else {
            $sucesso = false;
        }

        unset($_SESSION["mensagem-alterar-tinta"]);
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

    if($_SESSION["ADM"] == FALSE && $_SESSION["ADM"] == NULL) {
        header('location: index.php');
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
    <title>Bem vindo | Central Banco de Tintas</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- CSS -->
    <link rel="stylesheet" href="./css/main.css">
    <link rel="stylesheet" href="./css/navbarLogado.css">
    <link rel="stylesheet" href="./css/catalogo.css">

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

    <!-- Java Script -->
    <script src="js/scripts.js" defer></script>

    <link rel="shortcut icon" href="./icones/balde_tinta.png" type="image/x-icon">

    <style>
        .fechar-modal {
            position: absolute;
            left: 100%;
            top: -10%;
            padding: 10px;
            cursor: pointer;
        }

        .apagar-tinta-mensagem {
            color: white;
            text-align: center;
            font-size: 18px;
        }

        body.high-contrast .text_purple{
            color: white !important;
        }
    </style>

</head>

<body>
    <?php include 'navbar.php'; ?>
    
    <section class="pagina">
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
                    </ul>

                </div>

                <div class="col-lg-10 col-12 main-content">
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
                        
                    <h4 class="text_green_2 text-center text-lg-start">CATALOGO DE TINTAS</h4>
                    <div class="row cards-container">
                        <?php if($tabela): ?>
                            <?php while($linha = mysqli_fetch_array($tabela)): ?>
                                <?php
                                    $dataValidade = explode('-', $linha["dataValidade"]);
                                    $dataRecebimento = explode('-', $linha["dataRecebimento"]);
                                ?>
                                <div class="col-12 col-sm-10 col-md-8 col-lg-6 col-xxl-4">
                                    <div class="card mb-3">
                                        <div class="card-body text-start">
                                            <h4 class="card-title text_purple">#<?= $linha["identificacao"]; ?> Tinta <?= $linha["cor"]; ?>:</h4>
                                            
                                            <p class="card-text text_purple">
                                                Quantidade disponível: 
                                                <span class="text_green"><?= $linha["volume"]; ?>L</span>
                                            </p>
                                            <p class="card-text text_purple">
                                                Data de validade: 
                                                <span class="text_green"><?= $dataValidade[2]; ?>/<?= $dataValidade[1]; ?>/<?= $dataValidade[0]; ?></span>
                                            </p>
                                            <p class="card-text text_purple">
                                                Data de recebimento: 
                                                <span class="text_green"><?= $dataRecebimento[2]; ?>/<?= $dataRecebimento[1]; ?>/<?= $dataRecebimento[0]; ?></span>
                                            </p>
                                            <p class="card-text text_purple">
                                                Marca: 
                                                <span class="text_green"><?= $linha["marca"]; ?></span>
                                            </p>
                                            
                                            <div class="row align-items-center">
                                                <div class="col-sm-9 d-flex align-items-start">
                                                    <img class="img-fluid" src="<?= $linha["imagem"]; ?>" style="height: 150px; width: auto;">
                                                </div>
                                                <div class="col-sm-3 d-flex flex-column align-items-end">
                                                    <button class="btn btn-green btn_width trash_icon_position" id="btn-apagar<?= $linha["identificacao"]; ?>" onclick="modalApagar('<?= $linha['identificacao']; ?>')">
                                                        <img src="./icones/lixo.png" class="icone_position" width="20px" height="20px" alt="icone lixeira">  
                                                        Apagar Tinta
                                                    </button>
                                                    <form action="config/tintas_config.php" method="post">
                                                        <input type="hidden" name="apagar-tinta">
                                                        <input type="hidden" name="identificacao" value="<?= $linha["identificacao"]; ?>">
                                                        
                                                        <div id="modalBackgroundApagar<?= $linha["identificacao"]; ?>" class="modal-background"></div>
                                                        <div id="modalContainerApagar<?= $linha["identificacao"]; ?>" class="container-green">
                                                            <div class="fechar-modal" onclick="fecharModalApagar('<?= $linha['identificacao']; ?>')">
                                                                <img src="imagens/fechar.png" width="50px">
                                                            </div>
                                                            <h4 class="text_purple pad_bottom_20">Apagar Tinta</h4>
                                                            <p class="apagar-tinta-mensagem">Deseja mesmo apagar esta tinta permanentemente?</p>
                                                            <button class="btn btn-purple-editar" id="btnApagar<?= $linha["identificacao"]; ?>">Apagar</button>
                                                        </div>
                                                    
                                                    </form>
                                                    
                                                    <button class="btn btn-green btn_width edit_icon_position" id="btn-alterar<?= $linha["identificacao"]; ?>" onclick="modal('<?= $linha['identificacao']; ?>')">
                                                        <img src="./icones/editar.png" class="icone_position" width="20px" height="20px" alt="icone editar">
                                                        Alterar
                                                    </button>
                                                    <form action="config/tintas_config.php" method="post">
                                                        <input type="hidden" name="alterar-tinta">
                                                        <input type="hidden" name="identificacao" value="<?= $linha["identificacao"]; ?>">
                                                        
                                                        <div id="modalBackground<?= $linha["identificacao"]; ?>" class="modal-background"></div>
                                                        <div id="modalContainer<?= $linha["identificacao"]; ?>" class="container-green">
                                                            <div class="fechar-modal" onclick="fecharModal('<?= $linha['identificacao']; ?>')">
                                                                <img src="imagens/fechar.png" width="50px">
                                                            </div>
                                                            <h4 class="text_purple pad_bottom_20">Alterar Tinta</h4>
                                                            <div class="form-group">
                                                                <label for="marcaTinta" class="text_purple">Marca:</label>
                                                                <input type="text" class="form-control input-small" placeholder="Marca" name="marca<?= $linha["identificacao"]; ?>">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="dataVencimento" class="text_purple">Data de Vencimento:</label>
                                                                <input type="date" class="form-control input-small" placeholder="12/05/2024" name="dataVencimento<?= $linha["identificacao"]; ?>">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="quantidadeLatas" class="text_purple">Data de recebimento</label>
                                                                <input type="date" class="form-control input-small" placeholder="12/05/2024" name="dataRecebimento<?= $linha["identificacao"]; ?>">
                                                            </div>
                                                            <div class="form-group pad_bottom_20">
                                                                <label for="volumeLitros" class="text_purple">Volume em Litros:</label>
                                                                <input name="volume<?= $linha["identificacao"]; ?>" type="number" step=".01" class="form-control input-small" placeholder="Volume em litros">
                                                            </div>
                                                            <button class="btn btn-purple-editar" id="btnSalvar<?= $linha["identificacao"]; ?>">Salvar</button>
                                                        </div>
                                                    
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endwhile; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            
    </section>
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

        function modalApagar(id) {

            document.getElementById("modalBackgroundApagar" + id).style.display = "block";
            document.getElementById("modalContainerApagar" + id).style.display = "block";
            document.getElementById("modalContainerApagar" + id).style.backgroundColor = "#8eb041";

            document.getElementById("btnApagar" + id).addEventListener("click", function () {
                document.getElementById("modalBackgroundApagar" + id).style.display = "none";
                document.getElementById("modalContainerApagar" + id).style.display = "none";
            });

            document.getElementById("modalBackgroundApagar").addEventListener("click", function () {
                document.getElementById("modalBackgroundApagar" + id).style.display = "none";
                document.getElementById("modalContainerApagar" + id).style.display = "none";
            });
        }
        
        function fecharModalApagar(id) {
            document.getElementById("modalBackgroundApagar" + id).style.display = "none";
            document.getElementById("modalContainerApagar" + id).style.display = "none";
        }
    </script>
</body>

</html>