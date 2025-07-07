<?php
    session_start();

    if($_SESSION["ADM"] != FALSE) {
        header('location: catalogo.php');
    }

    if(isset($_SESSION["cadastro-login"])) {
        $mensagem = $_SESSION["cadastro-login"];

        if($mensagem == "Dados atualizados." || $mensagem == "Foto removida.") {
            $sucesso = true;
        }
        else {
            $sucesso = false;
        }

        unset($_SESSION["cadastro-login"]);
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
        include 'php/phpBD/conexaoBD.php';
        include 'php/phpBD/usuariosBD.php';
        include 'php/phpBD/tintasBD.php';
        include 'php/phpBD/pedidosBD.php';
        include 'php/phpBD/listaDesejosBD.php';

        $clienteId = $_SESSION["USUARIO"];

        $usuario = clientes_carregarPor_id($mysqli, $clienteId);
        $usuario = $usuario -> fetch_assoc();
        $mysqli -> next_result();

        $nome = explode(" ", $usuario["nome"]);
        $nome = $nome[0];

        $foto = $usuario["foto"];
    }

    $tabela = pedidos_carregarPor_clienteId($mysqli, $clienteId);
    $mysqli -> next_result();
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- fonte -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;700&display=swap" rel="stylesheet">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- CSS -->
    <link rel="stylesheet" href="css/usuario.css">
    <link rel="stylesheet" href="css/navbarLogado.css">

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

    <title>Banco de Tintas</title>

</head>

<body>
    <?php include 'navbar.php'; ?>
    
    <div class="container my-5 pagina ">
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
        
        <h1 class="mb-4">Perfil do Usuário</h1>

        <!-- Navegação por abas -->

        <ul class="nav nav-tabs" id="profileTabs" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="info-tab" data-bs-toggle="tab" data-bs-target="#info" type="button"
                    role="tab">Informações Pessoais</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="orders-tab" data-bs-toggle="tab" data-bs-target="#orders" type="button"
                    role="tab">Meus Pedidos</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="wishlist-tab" data-bs-toggle="tab" data-bs-target="#wishlist" type="button"
                    role="tab">Lista de Desejos</button>
            </li>
        </ul>

        <!-- Conteúdo das abas -->
        <div class="tab-content mt-3 justify-content-center" id="profileTabsContent">

            <!-- Aba de Informações Pessoais -->
            <div class="tab-pane fade show active" id="info" role="tabpanel" aria-labelledby="info-tab">
                <div class="dados_pessoais">
                    <div class="profile-img mx-auto mb-3">
                        <?php if($foto): ?>
                            <span><img class="usuario" src="<?= $foto; ?>" alt="Imagem do Usuario" style="border-radius: 100px;"></span>
                        <?php else: ?>
                            <span><img class="usuario" src="imagens/Usuario.png" alt="Imagem do Usuario"></span>
                        <?php endif; ?>
                    </div>
                    <div class="d-flex justify-content-center my-3">
                        <form action="php/usuarios_config.php" method="post">
                            <input type="hidden" name="remover-foto">
                            <button type="submit" class="btn btn-danger">Remover foto atual</button>
                        </form>
                    </div>

                    <form action="php/usuarios_config.php" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="alterar-usuario">
                        <div class="d-flex justify-content-center">
                            <input type="file" id="fileInput" name="foto">
                        </div>

                        <?php
                            $usuario = clientes_carregarPor_id($mysqli, $clienteId);
                            $usuario = $usuario -> fetch_assoc();
                        ?>

                        <!-- Nome -->
                        <div class="mb-3">
                            <label for="formInput" class="form-label">Nome</label>
                            <input type="text" class="form-control" id="Nome" name="nome" value="<?= $usuario['nome']?>">
                        </div>

                        <!-- e-mail -->
                        <div class="mb-3">
                            <label for="formInput" class="form-label">E-mail</label>
                            <input type="email" class="form-control" id="Email" placeholder="seu-email@gmail.com" name="email" value="<?= $usuario['email']?>">
                        </div>
                        <!-- Telefone -->
                        <div class="mb-3">
                            <label for="formInput" class="form-label">Telefone</label>
                            <input type="tel" class="form-control" id="Telefone" placeholder="(00) 00000-0000" name="telefone" value="<?= $usuario['telefone']?>">
                        </div>
                         
                        <button type="submit" class="btn btn-purple w-100">Salvar</button>
                    </form>
                </div>
            </div>

            <!-- Aba de Meus Pedidos com Accordion -->
            <div class="tab-pane fade" id="orders" role="tabpanel" aria-labelledby="orders-tab">
                <div class="d-flex justify-content-center">
                    <?php if($tabela): ?>
                        <div class="accordion" id="ordersAccordion">

                            <?php $cont = $tabela -> num_rows; ?>

                            <?php while($linha = $tabela -> fetch_assoc()): ?>
                                <?php
                                    $dataHora = $linha["dataHora"];
                                    $tintasIdentificacao = $linha["tintasIdentificacao"];
                                    $clienteId = $linha["clienteId"];

                                    $pedidoStatusTabela = pedidoStatus_carregarPor_pedidosIds($mysqli, $dataHora, $tintasIdentificacao, $clienteId);
                                    $pedidoStatus = $pedidoStatusTabela -> fetch_assoc();
                                    $mysqli -> next_result();

                                    $status = "Aguardando confirmação";
                                    $color = "orange";

                                    $dataHora = ["--", "--", "--", "--", "--", "--"];

                                    if($pedidoStatusTabela -> num_rows > 0) {
                                        
                                        $status = $pedidoStatus["status"];

                                        $data = str_replace(' ', ":", $pedidoStatus["dataHoraRetirada"]);
                                        $data = str_replace('-', ":", $data);
                                        $dataHora = explode(':', $data);

                                        if($status == "Aprovado" || $status == "Parcialmente aprovado") {
                                            $color = "green";
                                        }
                                        else if($status == "Reprovado") {
                                            $color = "red";
                                        }
                                    }

                                    $tinta = tintas_carregarPor_identificacao($mysqli, $tintasIdentificacao);
                                    $tinta = $tinta -> fetch_assoc();
                                    $mysqli -> next_result();
                                ?>

                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="<?= $cont; ?>">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?= $cont; ?>" aria-expanded="true" aria-controls="collapse<?= $cont; ?>">
                                            Pedido #<?= $cont; ?> - <?= $status; ?>
                                        </button>
                                    </h2>
                                    <div id="collapse<?= $cont; ?>" class="accordion-collapse collapse" aria-labelledby="<?= $cont; ?>" data-bs-parent="#ordersAccordion">
                                        <div class="accordion-body">
                                            <p>Detalhes do pedido #<?= $cont; ?>:</p>
                                            <ul>
                                                <li>
                                                    Tinta <?= $tinta["cor"]; ?>
                                                </li>
                                                <li>
                                                    Quantidade: <?= $tinta["volume"]; ?> litros
                                                </li>
                                                <li>
                                                    Status: 
                                                    <span style="color: <?= $color; ?>;"><?= $status; ?></span>
                                                </li>
                                                <li>
                                                    Data de retirada: <?= $dataHora[2]; ?>/<?= $dataHora[1]; ?>/<?= $dataHora[0]; ?>
                                                </li>
                                                <li>
                                                    Hora: <?= $dataHora[3]; ?>:<?= $dataHora[4]; ?>:<?= $dataHora[5]; ?>
                                                </li>
                                                <?php if($status == "Reprovado" || $status == "Parcialmente aprovado"): ?>
                                                    <li>
                                                        Observações: <?= $pedidoStatus["observacoes"]; ?>
                                                    </li>
                                                <?php endif; ?>
                                            </ul>
                                            <img src="<?= $tinta["imagem"]; ?>" class="img-fluid">
                                        </div>
                                    </div>
                                </div>
                                <?php $cont--; ?>    
                            <?php endwhile; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Aba de Lista de Desejos -->
            <div class="tab-pane fade" id="wishlist" role="tabpanel" aria-labelledby="wishlist-tab">
                <?php
                    $clienteId = $_SESSION["USUARIO"];
                    $tabela = listaDesejos_carregarPor_clienteId($mysqli, $clienteId);
                    $mysqli -> next_result();
                ?>
                <?php if($tabela): ?>
                    <div class="row">
                        <?php while($linha = $tabela -> fetch_assoc()): ?>
                            <?php
                                $identificacao = $linha["tintasIdentificacao"];

                                $tinta = tintas_carregarPor_identificacao($mysqli, $identificacao);
                                $tinta = $tinta -> fetch_assoc();
                                $mysqli -> next_result();
                            ?>
                            <div class="col-md-4 mb-3">
                                <div class="card h-100">   
                                    <img src="<?= $tinta["imagem"]; ?>" class="card-img-top" alt="Imagem do Produto A">
                                    <div class="card-body d-flex flex-column">
                                        <h5 class="card-title">Tinta <?= $tinta["cor"]; ?></h5>
                                        <div class="mt-auto d-flex justify-content-end">
                                            <form action="php/pedidos_config.php" method="post">
                                                <input type="hidden" name="remover-lista-desejos"/>
                                                <input type="hidden" name="cor" value="<?= $tinta["cor"]; ?>"/>
                                                <button type="submit" class="btn btn-outline-danger w-100 btn-sm">Remover</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endwhile; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</body>

</html>