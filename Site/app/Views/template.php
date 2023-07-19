<!doctype html>
<html lang="pt-br">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>MixBus</title>
  <link rel="stylesheet" href="./css/bootstrap/bootstrap.min.css">
  <link rel="stylesheet" href="./css/template.css">
  <link rel="shortcut icon" href="./img/icon.png" type="image/png">
  <?= $this->renderSection('css') ?>

</head>

<body>
  <header>
    <nav class="navbar navbar-expand-lg col-12" style="background-color: #0583F2;" data-bs-theme="dark">
      <div class="container-fluid">
        <a class="navbar-brand" href="/"><img src="./img/logoEscrita.svg" alt="Logo" width="110rem"></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link <?= $this->data["pagina"] == "home" ? 'active' : ''  ?>" aria-current="page" href="/">Início</a>
            </li>
            <li class="nav-item">
              <a class="nav-link <?= $this->data["pagina"] == "login" ? 'active' : ''  ?>" href="/login">Login</a>
            </li>
            <li class="nav-item">
              <a class="nav-link <?= $this->data["pagina"] == "sobre" ? 'active' : ''  ?>" href="/sobre">Sobre</a>
            </li>
          </ul>
          <form class="d-flex">
            <button type="button" class="btn btn-outline-light" data-bs-toggle="modal" data-bs-target="#exampleModal">Baixe o App</button>
          </form>
        </div>
      </div>
    </nav>
  </header>


  <!-- MODAL -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header" style="background-color: #0583F2; color: white;">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Aponte sua camera para o QR code</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-12">
              <img src="./img/QRcode.png" alt="" width="100%">
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <main class="row m-0">
    <?= $this->renderSection('conteudo') ?>
  </main>

  <footer></footer>







  <script src="./js/bootstrap/bootstrap.bundle.min.js"></script>
</body>

</html>