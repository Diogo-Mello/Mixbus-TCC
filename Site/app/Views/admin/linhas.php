<?php
$id = '';
$linhaOnibus = '';
$preco = '';
$fkcidadeIda = '';
$fkCidadeVolta = '';

if (isset($linhaAlterar)) {
    $id = $linhaAlterar["id"];
    $linhaOnibus = $linhaAlterar["linha"];
    $preco = $linhaAlterar["preco"];
    $fkcidadeIda = $linhaAlterar["fkcidadeIda"];
    $fkCidadeVolta = $linhaAlterar["fkCidadeVolta"];
}

?>

<?php $this->extend('admin/template') ?>

<?php $this->section('css') ?>
<link rel="stylesheet" href="../../css/linhas.css">
<?php $this->endSection() ?>

<?php $this->section('conteudo') ?>

<link rel="stylesheet" href="../css/linhas.css">

<div id="container" class="pt-5">
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nome</th>
                <th scope="col">Preço</th>
                <th scope="col">Cidade Ida</th>
                <th scope="col">Cidade Volta</th>
                <th scope="col">Opções</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($linhas as $linha) : ?>
                <tr>
                    <th scope="row"><?= $linha["id"] ?></th>
                    <td><?= esc($linha["linha"]) ?></td>
                    <td><?= esc($linha["preco"]) ?></td>
                    <td><?= esc($linha["Cidade ida"]) ?></td>
                    <td><?= esc($linha["Cidade Volta"]) ?></td>
                    <td>
                        <a class="btn btn-warning" href="/admin/linhas/<?= $linha["id"] ?>">
                            ALTERAR
                        </a>
                        <a class="btn btn-danger" href="javascript:remover(<?= $linha["id"] ?>)">
                            EXCLUIR
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#formulario">
        Adicionar
    </button>

</div>

<div class="modal fade" id="formulario" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Adicionar Linhas</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <?= form_open(base_url("admin/linhas/salvar")) ?>
            <div class="modal-body">
                <div class="form-group">
                    <label for="id">ID:</label>
                    <input type="text" class="form-control" id="id" name="id" value="<?= $id ?>" readonly>
                </div>
                <div class="form-group">
                    <label for="linha">Linhas:</label>
                    <input type="text" class="form-control" id="linha" name="linha" placeholder="Digite a linha" value="<?= $linhaOnibus  ?>" required>
                </div>
                <div class="form-group">
                    <label for="preco">Preço:</label>
                    <input type="text" class="form-control" id="preco" name="preco" placeholder="Digite o preco" value="<?= $preco ?>" required>
                </div>

                <div class="form-group">
                    <label for="fkcidadeIda" class="form-label">Ida:</label>
                    <select class="form-select" id="fkcidadeIda" name="fkcidadeIda">
                        <?php foreach ($cidades as $cidadeIda) : ?>
                            <?php if ($cidadeIda['id'] == $fkcidadeIda) : ?>
                                <option value="<?= $cidadeIda['id'] ?>" selected><?= esc($cidadeIda["nome"]) ?></option>
                            <?php else : ?>
                                <option value="<?= $cidadeIda['id'] ?>"><?= esc($cidadeIda["nome"]) ?></option>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="fkCidadeVolta" class="form-label">Volta:</label>
                    <select class="form-select" id="fkCidadeVolta" name="fkCidadeVolta">
                        <?php foreach ($cidades as $cidadeVolta) : ?>
                            <?php if ($cidadeVolta['id'] == $fkCidadeVolta) : ?>
                                <option value="<?= $cidadeVolta['id'] ?>" selected><?= esc($cidadeVolta["nome"]) ?></option>
                            <?php else : ?>
                                <option value="<?= $cidadeVolta['id'] ?>"><?= esc($cidadeVolta["nome"]) ?></option>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="fkEmpresa">Empresa:</label>
                    <select class="form-select" id="fkEmpresa" name="fkEmpresa">
                        <option value="1" selected readonly>Rápido Luxo Campinas</option>
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

        link.setAttribute("href", `/admin/linhas/remover/${id}`);

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
<?php if (isset($linhaAlterar)) : ?>
    <script>
        abrirForm();
    </script>
<?php endif; ?>
<?php $this->endSection() ?>