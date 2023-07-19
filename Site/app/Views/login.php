<?php $this->extend('template') ?>

<?php $this->section('css') ?>
<link rel="stylesheet" href="./css/login.css">
<?php $this->endSection() ?>

<?php $this->section('conteudo') ?>

<div>
    <div class="container col-5">
        <?= form_open(base_url("admin/logar")) ?>

        <div class="mb-3">
            <h1 style="font-family: 'Quicksand'; font-weight: bold;" class="text-center text-white">MIXBUS EMPRESAS</h1>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label text-white">Email:</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="email@mixbus.com">
        </div>
        <div class="mb-3">
            <label for="senha" class="form-label text-white">Senha:</label>
            <input type="password" class="form-control" id="senha" name="senha" placeholder="******">
        </div>

        <?php if (session()->has("aviso")) : ?>
            <p style="color: red;">
                <?= session("aviso") ?>
            </p>
        <?php endif; ?>

        <div class="mb-3 text-center">
            <button type="submit" class="btn btn-primary">Entrar</button>
        </div>


        <?php
        // echo '<a href="/cadastrar"><button type="button" class="btn btn-secondary">Criar Conta</button></a>'
        ?>



        <?= form_close(); ?>
    </div>


</div>


<?php $this->endSection() ?>