<?php
    session_start();
    if(isset($_SESSION["mensagem-cadastrar-tinta"])) {
        $mensagem = $_SESSION["mensagem-cadastrar-tinta"];

        if($mensagem == "Tinta cadastrada.") {
            $sucesso = true;
        }
        else {
            $sucesso = false;
        }

        unset($_SESSION["mensagem-cadastrar-tinta"]);
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

    <!-- script -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Javascritp -->
    <script src="./js/scripts.js"></script>

    <!-- FontAwesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" rel="stylesheet">

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
                        
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="row justify-content-center">
                                    <div class="col-xl-10 col-lg-12">
                                        <form action="config/tintas_config.php" method="post"
                                            enctype="multipart/form-data">
                                            <input type="hidden" name="cadastrar-tinta">
                                            <h4 class="text_light_green ">CADASTRAR TINTA</h4>
                                            <div class="row bg_lilac">

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="nomeTinta"
                                                            class="text_black pad_top_bt_5">Identificação:</label>
                                                        <input type="text" class="form-control" id="nomeTinta"
                                                            placeholder="Ex.: 01 ou A ou 1A..." name="identificacao"
                                                            required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="corTinta"
                                                            class="text_black pad_top_bt_5">Cor:</label>
                                                        <input type="text" class="form-control" id="corTinta"
                                                            placeholder="Cor" name="cor" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="marcaTinta"
                                                            class="text_black pad_top_bt_5">Marca:</label>
                                                        <input type="text" class="form-control" id="marcaTinta"
                                                            placeholder="Marca" name="marca">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="dataVencimento" class="text_black pad_top_bt_5">Data
                                                            de Vencimento:</label>
                                                        <input type="date" class="form-control" id="DataVencimento"
                                                            placeholder="12/05/2024" name="dataVencimento" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="quantidadeLatas"
                                                            class="text_black pad_top_bt_5">Data de recebimento</label>
                                                        <input type="date" class="form-control" id="DataRecebimento"
                                                            placeholder="12/05/2024" name="dataRecebimento" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="volumeLitros" class="text_black pad_top_bt_5">Volume
                                                            em Litros: </label>
                                                        <input type="number" step=".01" class="form-control"
                                                            id="volumeLitros" placeholder="Volume em litro"
                                                            name="volume" required>
                                                    </div>
                                                    <div class="form-group">

                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="uploadImagem" class="text_black pad_top_bt_5">Upload
                                                            da Imagem:</label>
                                                        <div class="border p-1 d-flex flex-column justify-content-center align-items-center"
                                                            style="height: 90px; background-color: #f9f9f9; border-radius: 5px;">
                                                            <span class="text_black">Arraste e solte o arquivo JPEG ou
                                                                PNG aqui</span>
                                                            <button type="button" class="btn btn-green mt-1"
                                                                onclick="document.getElementById('uploadImagem').click();">
                                                                Selecionar arquivo
                                                            </button>
                                                            <input type="file" class="form-control-file"
                                                                id="uploadImagem" name="imagem"
                                                                style="opacity: 0; position:absolute;" required>
                                                        </div>
                                                    </div>

                                                    <div class="mt-2">
                                                        <img alt=""
                                                            id="img-tintas">
                                                    </div>
                                                </div>

                                                <div class="text-center mt-4">
                                                    <button type="submit" class="btn btn-green col-8">Cadastrar</button>
                                                </div>
                                            </div>
                                        </form>
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
        let imagem = document.getElementById("img-tintas");
        let botaoImagem = document.getElementById("uploadImagem");

        botaoImagem.addEventListener('change', () => {

            if (botaoImagem.files.lenght <= 0) {
                return;
            }

            let leitor = new FileReader();

            leitor.onload = () => {
                imagem.src = leitor.result;
            }

            console.log(imagem.src);

            leitor.readAsDataURL(botaoImagem.files[0]);
        });
    </script>
</body>

</html>