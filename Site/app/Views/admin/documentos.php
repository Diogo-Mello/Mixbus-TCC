<?php

?>

<?php $this->extend('admin/template') ?>

<?php $this->section('css') ?>
<link rel="stylesheet" href="../../css/documentos.css">
<?php $this->endSection() ?>

<?php $this->section('conteudo') ?>

<div class="col-6 d-flex justify-content-center">
    <div class="col-6 mt-5 text-center">
        <?= form_open(base_url("/admin/documentos/pedidoDocumentos")) ?>

        <div class="form-group">
            <label for="pedido" style="color: white;">Qual tabéla de horarios você deseja imprimir:</label>
            <select class="form-control" id="pedido" name="pedido" required>
                <?php foreach ($linhas as $linha) : ?>
                    <option value="<?=$linha['id']?>">Linha: <?= $linha['linha']?> <?= $linha['cidadeIda'] ?> - <?= $linha['cidadeVolta'] ?></option>
                <?php endforeach ?>
            </select>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Pedir</button>
        <?= form_close() ?>
    </div>
</div>

<?php $this->endSection() ?>