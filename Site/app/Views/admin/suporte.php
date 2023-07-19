<?php
$suporteId = "";
$suportePergunta = "";

if (isset($suporteBusca)) {
    $suporteId = $suporteBusca['id'];
    $suportePergunta = $suporteBusca['descricao'];
}
?>

<?php $this->extend('admin/template') ?>

<?php $this->section('css') ?>
<link rel="stylesheet" href="../../css/suporte.css">
<?php $this->endSection() ?>

<?php $this->section('conteudo') ?>

<div id="container">

        <div id="suportes" class="mt-3">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">descrição</th>
                    <th scope="col">Resposta</th>
                    <th scope="col">Opções</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($suporte as $suporte): ?>
                <tr>
                    <th scope="row"><?= $suporte["id"] ?></th>
                    <td><?= esc($suporte["descricao"]) ?></td>
                    <td><?= esc($suporte["resposta"]) ?></td>
                    <td>
                        <?php if($suporte["resposta"] == "") :?>
                        <a class="btn btn-success" href="/admin/suporte/<?= $suporte["id"] ?>">
                            RESPONDER
                        </a>
                        <?php else :?>
                        <a class="btn btn-danger" href="javascript:remover(<?= $suporte["id"] ?>)">
                            EXCLUIR
                        </a>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach;?>
            </tbody>
        </table>
        </div>
</div>

<div class="modal fade" id="formulario" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Adicionar motorista</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <?= form_open(base_url("admin/suporte/salvar")) ?>
            <div class="modal-body">
                <div class="form-group">
                    <label for="id">ID:</label>
                    <input type="text" class="form-control" id="id" name="id" value="<?= $suporteId ?>" readonly>
                </div>
                <br>
                <div class="form-group">
                    <label for="pergunta">Suporte:</label><br>
                    <span name="pergunta" id="pergunta"><?= $suportePergunta ?></span>
                </div>
                <br>
                <div class="form-group">
                    <label for="resposta">Resposta:</label>
                    <input type="text" class="form-control" id="resposta" name="resposta" value="" require min="2">
                </div>
                <div class="form-group">
                    <label for="resolvido">Status:</label>
                    <select class="form-control" id="resolvido" name="resolvido" required>
                        <option value="0">Em andamento</option>
                        <option value="1">Resolvido</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                <button type="submit" class="btn btn-primary">Salvar</button>
            </div>
            <?= form_close() ?>
        </div>
    </div>
</div>

<div class="modal fade" id="confirm">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5">Atenção</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Deseja realmente apagar este item?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <a href=# class="btn btn-danger" id="link-exclusao">Apagar</a>
            </div>
        </div>
    </div>
</div>

<script>
    function remover(id) {
        const link = document.getElementById("link-exclusao");
        const modalExclusao =
            new bootstrap.Modal(document.getElementById("confirm"), {});

        link.setAttribute("href", `/admin/suporte/remover/${id}`);

        modalExclusao.show();
    }

    function abrirForm() {
        const modalForm =
            new bootstrap.Modal(document.getElementById("formulario"), {});
        modalForm.show();
    }
</script>

<?php $this->endSection() ?>

<?php $this->section('conteudoPosterior') ?>
<?php if (isset($suporteBusca)) : ?>
    <script>
        abrirForm();
    </script>
<?php endif; ?>
<?php $this->endSection() ?>

