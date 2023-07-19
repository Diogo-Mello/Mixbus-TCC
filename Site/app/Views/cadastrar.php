<?php $this->extend('template') ?>
<?php $this->section('conteudo') ?>

<div>
    <div class="container">
        <div class="mb-3 pt-5">
            <h1 style="font-family: 'Quicksand'; font-weight: bold;" class="text-start text-white">CRIAR CONTA:</h1>
        </div>

        <?= form_open(base_url("admin/cadastro")) ?>

        <div class="mb-3">
            <label for="nomeEmpresa" class="form-label text-white">Nome da empresa:</label>
            <input type="text" class="form-control" name="nomeEmpresa" id="nomeEmpresa" placeholder="Nome">
        </div>

        <div class="mb-3">
            <label for="cnpj" class="form-label text-white">CNPJ:</label>
            <input type="text" class="form-control" id="cnpj" name="cnpj" placeholder="00.000.000/0000-00">
        </div>

        <div class="mb-3">
            <label for="telefone" class="form-label text-white">CNPJ:</label>
            <input type="text" class="form-control" id="telefone" name="telefone" placeholder="(99) 99999-9999">
        </div>

        <div class="mb-3">
            <label for="email" class="form-label text-white">Email:</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="email@email.com">
        </div>

        <div class="mb-3 col-6">
            <label for="senha" class="form-label text-white">Senha:</label>
            <input type="password" class="form-control" id="senha" name="senha" placeholder="******">
        </div>

        <div class="mb-3 col-6">
            <label for="confirmarSenha" class="form-label text-white">Confirmar senha:</label>
            <input type="password" class="form-control" id="confirmarSenha" name="confirmarSenha" placeholder="******">
        </div>

        <!-- <div class="mb-3">
        <label for="formFile" class="form-label text-white">Logo da empresa:</label>
        <input class="form-control" type="file" id="formFile">
    </div> -->

        <?php if (session()->has("aviso")) : ?>
            <p style="color: red;">
                <?= session("aviso") ?>
            </p>
        <?php endif; ?>

        <div class="mb-3">
            <button type="submit" class="btn btn-primary">Criar Conta</button>
            <button type="reset" class="btn btn-warning">Limpar</button>
        </div>

        <?= form_close() ?>
    </div>
</div>




<?php $this->endSection() ?>