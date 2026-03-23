<?php
session_start();
if (isset($_SESSION["mensagem-cadastrar-tinta"])) {
    $mensagem = $_SESSION["mensagem-cadastrar-tinta"];

    if ($mensagem == "Tinta cadastrada.") {
        $sucesso = true;
    } else {
        $sucesso = false;
    }

    unset($_SESSION["mensagem-cadastrar-tinta"]);
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
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bem vindo | Catálogo de Tintas</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- CSS -->
    <!-- <link rel="stylesheet" href="./css/main.css"> -->
    <link rel="stylesheet" href="./css/navbarLogado.css">
    <link rel="stylesheet" href="./css/cadastrartinta.css">

    <!-- FontAwesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" rel="stylesheet">

    <!-- script -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <link rel="shortcut icon" href="imagens/Logo.png" type="image/x-icon">

</head>

<body>
    <?php include 'navbar.php'; ?>

    <section class="pagina">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-2 col-12 sidebar">
                    <ul class="nav flex-column">
                        <li class="nav-item pad_top_20">
                            <a class="nav-link text-dark link_bg_adm" href="pedidos.php">
                                <i class=" menu-icon fa-solid fa-list-check"></i>
                                Pedidos
                            </a>
                        </li>
                        <li class="nav-item pad_top_20">
                            <a class="selected nav-link" href="cadastrar_tinta.php" title="Você já está nesta página">
                                <i class="menu-icon fa-regular fa-pen-to-square"></i>
                                Cadastrar tinta
                            </a>
                        </li>

                        <li class="nav-item pad_top_20">
                            <a class="nav-link text-dark link_bg_adm" href="catalogo.php">
                                <i class="menu-icon fa-solid fa-list"></i>
                                Catálogo
                            </a>
                        </li>
                        <li class="nav-item pad_top_20">
                            <a class="nav-link text-dark link_bg_adm" href="lixeira.php">
                                <i class="menu-icon fa-regular fa-trash-can"></i>
                                Lixeira
                            </a>
                        </li>
                    </ul>
                </div>

                <div class="col-lg-10 col-12 main-content">

                    <div class="row">
                        <form action="config/tintas_config.php" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="cadastrar-tinta">
                            <div class="row bg_lilac">
                                <div class="col-md-6">
                                    <div class="form-group mt-4 mb-3">
                                        <label for="nomeTinta" class="text_black">Identificação:</label>
                                        <input type="text" class="form-control" id="nomeTinta"
                                            placeholder="Ex.: 01 ou A ou 1A..." name="identificacao" required>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="corTinta" class="text_black ">Cor:</label>
                                        <input type="text" class="form-control" id="corTinta" placeholder="Cor"
                                            name="cor" required>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="marcaTinta" class="text_black ">Marca:</label>
                                        <input type="text" class="form-control" id="marcaTinta" placeholder="Marca"
                                            name="marca">
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="dataVencimento" class="text_black ">Data
                                            de Vencimento:</label>
                                        <input type="date" class="form-control" id="DataVencimento"
                                            placeholder="12/05/2024" name="dataVencimento" required>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="quantidadeLatas" class="text_black ">Data de
                                            recebimento</label>
                                        <input type="date" class="form-control" id="DataRecebimento"
                                            placeholder="12/05/2024" name="dataRecebimento" required>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="volumeLitros" class="text_black ">Volume
                                            em Litros: </label>
                                        <input type="number" step=".01" class="form-control" id="volumeLitros"
                                            placeholder="Volume em litro" name="volume" required>
                                    </div>

                                </div>

                                <div class="col-md-6">
                                    <div class="form-group mt-4 mb-3">
                                        <label for="uploadImagem" class="text_black ">Upload
                                            da Imagem:</label>
                                        <div
                                            class="upload-img border p-1 d-flex flex-column justify-content-center align-items-center">
                                            <span class=" text_black">Arraste e solte o arquivo JPEG ou
                                                PNG aqui</span>
                                            <button type="button" class="btn btn-green mt-1"
                                                onclick="document.getElementById('uploadImagem').click();">
                                                Selecionar arquivo
                                            </button>
                                            <input type="file" class="form-control-file" id="uploadImagem" name="imagem"
                                                required>
                                        </div>
                                    </div>

                                    <div class="mt-2">
                                        <img alt="" id="img-tintas">
                                    </div>
                                </div>

                                <div class="text-center mt-4 mb-3">
                                    <button type="submit" class="btn btn-save col-8">Cadastrar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <script src="js/scripts.js" defer></script>
</body>

</html>