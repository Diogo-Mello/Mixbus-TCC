<?php $this->extend('admin/template') ?>

<?php $this->section('css') ?>
<link rel="stylesheet" href="../../css/painel.css">
<?php $this->endSection() ?>

<?php $this->section('conteudo') ?>

<div class="card mt-4" style="width: 20rem;">
  <img src="<?= $dados[0]['logo'] ?>" class="card-img-top" alt="...">
  <div class="card-body">
    <h5 class="card-title">Olá <?= esc($dados[0]['nome']) ?></h5>
    <p class="card-text">Bem-vindo ao paínel de controle do Mixbus! Acesse a barra ao lado para ter acesso a todas as configurações.</p>
  </div>
</div>

<?php $this->endSection() ?>