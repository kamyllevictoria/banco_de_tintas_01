<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bem vindo | Pedidos</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <link rel="stylesheet" href="./css/pedidos.css">
    <link rel="stylesheet" href="./css/navbarLogado.css">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <script src="./js/scripts.js"></script>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" rel="stylesheet">
    <link rel="shortcut icon" href="imagens/Logo.png" type="image/x-icon">
</head>

<body>
    <section class="pedidos">
        <?php include 'navbar.php'; ?>
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-2 pb-3 col-12 sidebar">
                    <h4 class="menu_text">MENU</h4>
                    <ul class="nav flex-column">
                        <li class="nav-item pad_top_20">
                            <a class="nav-link text-dark link_bg_adm" href="pedidos.php">Pedidos</a>
                        </li>
                        <li class="nav-item pad_top_20">
                            <a class="nav-link text-dark link_bg_adm" href="cadastrar_tinta.php">Cadastrar tinta</a>
                        </li>

                        <li class="nav-item pad_top_20">
                            <a class="nav-link text-dark link_bg_adm" href="catalogo.php">Catálogo</a>
                        </li>
                        <li class="nav-item pad_top_20">
                            <a class="nav-link text-dark link_bg_adm" href="lixeira.php">Lixeira</a>
                        </li>
                    </ul>
                </div>

                <div class="col-lg-10 col-12 main-content p-4">
                    <div class="container-fluid p-0">
                        <div class="d-flex flex-wrap align-items-center p-3 mb-3 custom-card-header">
                            <span class="me-3 text-nowrap select-text">Selecione um pedido e escolha o que você quer
                                fazer</span>
                            <div class="d-flex flex-wrap flex-grow-1 justify-content-end">
                                <button class="btn btn-purple m-1">Aprovar</button>
                                <button class="btn btn-purple m-1">Aprovar parcialmente</button>
                                <button class="btn btn-purple m-1">Reprovar</button>
                                <button class="btn btn-purple m-1">Finalizar</button>
                                <button class="btn btn-purple m-1">Cancelar</button>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table pedidos-table">
                                <thead class="table-header">
                                    <tr>
                                        <th scope="col" style="width: 5%;"></th>
                                        <th scope="col" class="status-col">Status</th>
                                        <th scope="col">Nº</th>
                                        <th scope="col">Quantidade</th>
                                        <th scope="col">Data</th>
                                        <th scope="col">Cor</th>
                                        <th scope="col">Contato</th>
                                        <th scope="col">Solicitante</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="pedido-row">
                                        <td data-label="Selecionar"><input class="form-check-input" type="checkbox">
                                        </td>
                                        <td data-label="Status" class="status-cell">Aprovado</td>
                                        <td data-label="Nº">45689</td>
                                        <td data-label="Quantidade">5 L</td>
                                        <td data-label="Data">04/05/2025</td>
                                        <td data-label="Cor">Azul</td>
                                        <td data-label="Contato">11 950322638</td>
                                        <td data-label="Solicitante">Sarah</td>
                                    </tr>
                                    <tr class="pedido-row">
                                        <td data-label="Selecionar"><input class="form-check-input" type="checkbox">
                                        </td>
                                        <td data-label="Status" class="status-cell">Reprovado</td>
                                        <td data-label="Nº">45688</td>
                                        <td data-label="Quantidade">2 L</td>
                                        <td data-label="Data">04/05/2025</td>
                                        <td data-label="Cor">Azul</td>
                                        <td data-label="Contato">11 950322638</td>
                                        <td data-label="Solicitante">Jubileu</td>
                                    </tr>
                                    <tr class="pedido-row">
                                        <td data-label="Selecionar"><input class="form-check-input" type="checkbox">
                                        </td>
                                        <td data-label="Status" class="status-cell">Finalizado</td>
                                        <td data-label="Nº">45687</td>
                                        <td data-label="Quantidade">1,5 L</td>
                                        <td data-label="Data">04/05/2025</td>
                                        <td data-label="Cor">Azul</td>
                                        <td data-label="Contato">11 950322638</td>
                                        <td data-label="Solicitante">Maria Luiza</td>
                                    </tr>
                                    <tr class="pedido-row">
                                        <td data-label="Selecionar"><input class="form-check-input" type="checkbox">
                                        </td>
                                        <td data-label="Status" class="status-cell">Cancelado</td>
                                        <td data-label="Nº">45686</td>
                                        <td data-label="Quantidade">3,8 L</td>
                                        <td data-label="Data">04/05/2025</td>
                                        <td data-label="Cor">Azul</td>
                                        <td data-label="Contato">11 950322638</td>
                                        <td data-label="Solicitante">Zézinho</td>
                                    </tr>
                                    <tr class="pedido-row">
                                        <td data-label="Selecionar"><input class="form-check-input" type="checkbox">
                                        </td>
                                        <td data-label="Status" class="status-cell">Aprovado parcialmente</td>
                                        <td data-label="Nº">45686</td>
                                        <td data-label="Quantidade">10 L</td>
                                        <td data-label="Data">04/05/2025</td>
                                        <td data-label="Cor">Azul</td>
                                        <td data-label="Contato">11 950322638</td>
                                        <td data-label="Solicitante">Zézinho</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</body>

</html>