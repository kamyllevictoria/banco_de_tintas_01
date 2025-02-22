<?php
    session_start();

    if(isset($_SESSION["mensagem-aprovar-pedido"])) {
        $mensagem = $_SESSION["mensagem-aprovar-pedido"];

        if($mensagem == "Status do pedido confirmado.") {
            $sucesso = true;
        }
        else {
            $sucesso = false;
        }

        unset($_SESSION["mensagem-aprovar-pedido"]);
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
    $tabela = mysqli_query($conexao, "CALL pedidos_carregar()");
    mysqli_close($conexao);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bem vindo | Pedidos</title>

    <!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- CSS -->
    <link rel="stylesheet" href="./css/main.css">
    <link rel="stylesheet" href="./css/pedidos.css">
    <link rel="stylesheet" href="./css/navbarLogado.css">

    <!-- script -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Javascritp -->
    <script src="./js/scripts.js"></script>

    <!-- FontAwesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" rel="stylesheet">

    <link rel="shortcut icon" href="./icones/balde_tinta.png" type="image/x-icon">

    <style>
        body.high-contrast .text_purple{
            color: white !important;
        }
    </style>
</head>

<body>
    <?php include 'navbar.php'; ?>

    <section class="pedidos">
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

                    <h4 class="text_green_2 text-center text-lg-start">PEDIDOS A SEREM APROVADOS</h4>
                    <?php if($tabela): ?>
                        <div class="row cards-container">
                            <?php $cont = 1; ?>
                            <?php while($linha = mysqli_fetch_array($tabela)): ?>
                                <?php 
                                    $conexao = mysqli_connect("localhost", "root", "","banco_tintas") or die ("Falha na conexão");
        
                                    $dataHora = $linha["dataHora"];
                                    $tintasIdentificacao = $linha["tintasIdentificacao"];
                                    $clienteId = $linha["clienteId"];
        
                                    $pedidoStatus = mysqli_query($conexao, "CALL pedidoStatus_carregarPor_pedidosIds('$dataHora', '$tintasIdentificacao', '$clienteId')");
                                    mysqli_close($conexao);
        
                                    $qtde_linhas = mysqli_num_rows($pedidoStatus);
                                ?>
                                <?php if($qtde_linhas == 0): ?>
                                    <?php
                                        $conexao = mysqli_connect("localhost", "root", "","banco_tintas") or die ("Falha na conexão");
            
                                        $cliente = mysqli_query($conexao, "CALL clientes_carregarPor_id('$clienteId')");
                                        $cliente = mysqli_fetch_array($cliente);
                                        mysqli_close($conexao);
            
                                        $conexao = mysqli_connect("localhost", "root", "","banco_tintas") or die ("Falha na conexão");
            
                                        $tinta = mysqli_query($conexao, "CALL tintas_carregarPor_identificacao('$tintasIdentificacao')");
                                        $tinta = mysqli_fetch_array($tinta);
                                        mysqli_close($conexao);
            
                                        $data = str_replace(' ', ":", $linha["dataHora"]);
                                        $data = str_replace('-', ":", $data);
                                        $dataHora = explode(':', $data);
                                    ?>
                                    <div class="col-12 col-sm-10 col-md-8 col-lg-6 col-xxl-4">
                                        <div class="card">
                                            <div class="card-body text-start">
                                                <h4 class="card-title text_purple">
                                                    Pedido: 
                                                    <?= $dataHora[2]; ?>/<?= $dataHora[1]; ?>/<?= $dataHora[0]; ?> 
                                                    <?= $dataHora[3]; ?>:<?= $dataHora[4]; ?>:<?= $dataHora[5]; ?>
                                                </h4>
                                                <p class="card-text text_purple">'
                                                    Solicitado por: 
                                                    <span class="text_green"><?= $cliente["nome"]; ?></span>
                                                </p>
                                                <p class="card-text text_purple">
                                                    Quantidade: 
                                                    <span class="text_green"><?= $linha["volume"]; ?>L</span>
                                                </p>
                                                <p class="card-text text_purple">
                                                    Identificação da tinta: 
                                                    <span class="text_green"><?= $tintasIdentificacao; ?></span>
                                                </p>
                                                <p class="card-text text_purple">
                                                    Cor: 
                                                    <span class="text_green"><?= $tinta["cor"]; ?></span>
                                                </p>
                                                <form action="config/pedidos_config.php" method="post">
                                                    <input type="hidden" name="clienteId" value="'.$clienteId.'">
                                                    <input type="hidden" name="aprovar-pedido">
                                                    <input type="hidden" name="identificacao" value="<?= $tintasIdentificacao; ?>">
                                                    <input type="hidden" name="dataHora" value="<?= $linha["dataHora"]; ?>">
                                                    <div class="status-container">
                                                        <p class="text_magenta">Status do pedido:</p>
                                                        <select name="statusOpcoes<?= $tintasIdentificacao; ?>" id="statusOpcoe<?= $cont; ?>" onchange="opcoes('<?= $cont; ?>')" class="statusDropdown form-select">
                                                            <option value="">Selecione...</option>
                                                            <option value="1">Aprovado</option>
                                                            <option value="2">Parcialmente Aprovado</option>
                                                            <option value="3">Reprovado</option>
                                                        </select>
                                                    </div>
                                                    <div id="formularioRetirada<?= $cont; ?>" class="formulario-retirada" style="display:none;">
                                                        <div class="campo-data-hora">
                                                            <label for="data_retirada">Data de retirada:</label>
                                                            <input type="date" name="data_retirada<?= $tintasIdentificacao; ?>" id="Data_retirada<?= $tintasIdentificacao; ?>">
                                                        </div>
                                                        <div class="campo-data-hora">
                                                            <label for="hora_retirada">Horário para Retirada:</label>
                                                            <input type="time" name="hora_retirada<?= $tintasIdentificacao; ?>" id="Hora_retirada<?= $tintasIdentificacao; ?>">
                                                        </div>
                                                    </div>
                                                    <div class="formulario-observacoes" id="formularioObservacoes<?= $cont; ?>" style="display:none; margin-top: 5px;">
                                                        <textarea name="observacoes<?= $tintasIdentificacao; ?>" id="Observacoes<?= $tintasIdentificacao; ?>" style="width: 100%;" placeholder="Observações"></textarea>
                                                    </div>
                                                    <div id="salvarDados<?= $cont; ?>" style="display: none;">
                                                        <button class="btn-green btn" style="margin-top: 5px;">Salvar dados</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <?php $cont++; ?>
                                <?php endif; ?>
                            <?php endwhile; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>
    <script>
        document.querySelectorAll('.statusDropdown').forEach((dropdown) => {
            dropdown.addEventListener('change', function () {
                const status = this.value;
                const statusTextDiv = this.closest('.card-body').querySelector('.statusText');

                if (status) {
                    statusTextDiv.textContent = `Status: ${status.charAt(0).toUpperCase() + status.slice(1)}`;
                } else {
                    statusTextDiv.textContent = '';
                }
            });
        });
    </script>

    <script>
        function opcoes(id) {
            let statusDropdown = document.getElementById("statusOpcoe" + id);
            let status = statusDropdown.value;

            let formularioRetirada = document.getElementById("formularioRetirada" + id);
            let formularioObservacoes = document.getElementById("formularioObservacoes" + id);
            let btnSalvarDados = document.getElementById("salvarDados" + id);

            let data = document.getElementById("Data_retirada" + id);
            let hora = document.getElementById("Hora_retirada" + id);
            let observacoes = document.getElementById("Observacoes" + id);

            if (status === "1") {
                formularioRetirada.style.display = 'block';
                formularioObservacoes.style.display = 'none';
                btnSalvarDados.style.display = 'block';

            } else if (status === "2") {
                formularioRetirada.style.display = 'block';
                formularioObservacoes.style.display = 'block';
                btnSalvarDados.style.display = 'block';

            } else if (status == "3") {
                formularioRetirada.style.display = 'none';
                formularioObservacoes.style.display = 'block';
                btnSalvarDados.style.display = 'block';
            }
            else {
                formularioRetirada.style.display = 'none';
                formularioObservacoes.style.display = 'none';
                btnSalvarDados.style.display = 'none';
            }
        }
    </script>
</body>
</html>