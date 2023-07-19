<!doctype html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>MixBus Empresas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/template.css">
    <link rel="shortcut icon" href="../img/icon.png" type="image/png">
    <?= $this->renderSection('css') ?>

</head>

<body>
    <nav class="navbar position-relative" style="background-color: #0583F2;">
        <div class="container-fluid">
            <a class="navbar-brand" href="/admin/painel"><img src="../../img/logoEmpresas.svg" alt="Logo" width="200rem"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Painel de controle</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                        <!-- <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#">Home</a>
                        </li> -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Dados
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="/admin/motoristas">Motoristas</a></li>
                                <li><a class="dropdown-item" href="/admin/linhas">Linhas</a></li>
                                <li><a class="dropdown-item" href="/admin/horarios">Horarios</a></li>
                                
                                <li><hr class="dropdown-divider"></li>

                                <li><a class="dropdown-item" href="/admin/suporte">Suporte</a></li>

                                <li><hr class="dropdown-divider"></li>

                                <li><a class="dropdown-item" href="/admin/empresa">Empresa</a></li>

                            </ul>
                        </li>

                        <?php 
                        $documentos = false;

                        if ($documentos) {
                        echo 
                        '
                        <li class="nav-item">
                            <a class="nav-link" href="/admin/documentos">Documentos</a>
                        </li>
                        ';
                        }
                        ?>

                        <li class="nav-item">
                            <a class="nav-link" style="color: red;" href="<?=base_url("admin/sair")?>">Sair</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    <main class="row m-0">
        <?= $this->renderSection('conteudo') ?>
    </main>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>

    <?= $this->renderSection('conteudoPosterior') ?>
</body>

</html>