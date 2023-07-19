<?php
$id = '';
$diaSemanal = '';
$horarioIda = '';
$horarioVolta = '';
$fkLinha = '';
$verificador = true;
$verificadorDiasUteis = true;
$verificadorSabados = true;
$verificadorDomingos = true;

if (isset($horarios) && count($horarios) == 0) {
    $verificador = false;
}

if (isset($horarioAlterar)) {
    $id = $horarioAlterar["id"];
    $diaSemanal = $horarioAlterar["diaSemanal"];
    $horarioIda = $horarioAlterar["horarioIda"];
    $horarioVolta = $horarioAlterar["horarioVolta"];
    $fkLinha = $horarioAlterar["fkLinha"];
}

$horarioDiasUteis = array();
$horarioSabados = array();
$horarioDomingosFeriados = array();

if (isset($horarios) && $verificador) {
    foreach ($horarios as $separacao) {
        $separacao['diaSemanal'] == 'DIAS UTEIS' ? $horarioDiasUteis[] = $separacao : ($separacao['diaSemanal'] == 'SÁBADOS' ? $horarioSabados[] = $separacao : $horarioDomingosFeriados[] = $separacao);
    }
}

if (count($horarioDiasUteis) == 0) {
    $verificadorDiasUteis = false;
}
if (count($horarioSabados) == 0) {
    $verificadorSabados = false;
}
if (count($horarioDomingosFeriados) == 0) {
    $verificadorDomingos = false;
}

?>

<?php $this->extend('admin/template') ?>

<?php $this->section('css') ?>
<link rel="stylesheet" href="../../css/horarios.css">
<?php $this->endSection() ?>

<?php $this->section('conteudo') ?>

<div class="container col-12">
    <?= form_open(base_url("admin/horarios")) ?>
    <div id="linhas" class="col-6">
        <div class="form-group col-12">

            <label for="linha" class="form-label text-white">Selecione uma linha:</label>
            <select class="form-select" id="linha" name="linha">
                <?php foreach ($linhas as $linha) : ?>
                    <option value="<?= $linha['id'] ?>">Linha: <?= $linha['linha'] ?> <?= $linha['cidadeIda'] ?> - <?= $linha['cidadeVolta'] ?></option>
                <?php endforeach ?>
            </select>

            <button class="btn btn-primary mt-2" type="submit">Selecionar</button>

            <button class="btn btn-secondary mt-1" type="button" data-bs-toggle="modal" data-bs-target="#formulario">Adicionar</button>
        </div>
    </div>
    <?= form_close() ?>

    <?php if (isset($horarios) && $verificador) : ?>
        <div class="col-6 horarios mt-3">
            <?php if ($verificadorDiasUteis) : ?>
                <table>
                    <thead>
                        <tr>
                            <th scope="col" colspan="2">Linha: <?= esc($horarios[0]['linha']) ?></th>
                            <th scope="col" colspan="2"><?= esc($horarioDiasUteis[0]['diaSemanal']) ?></th>
                        </tr>
                        <tr>
                            <th scope="col"><?= esc($horarios[0]['cidadeIda']) ?></th>
                            <th scope="col"><?= esc($horarios[0]['cidadeVolta']) ?></th>
                            <th scope="col" colspan="2">Opções</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php foreach ($horarioDiasUteis as $dia1) : ?>
                            <tr>
                                <td><?= esc($dia1['horarioIda']) ?></td>
                                <td><?= esc($dia1['horarioVolta']) ?></td>
                                <td>
                                    <a class="btn btn-warning btn-sm" href="/admin/horarios/<?= $dia1["id"] ?>">
                                        ALTERAR
                                    </a>
                                </td>
                                <td>
                                    <a class="btn btn-danger btn-sm" href="javascript:remover(<?= $dia1["id"] ?>)">
                                        EXCLUIR
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif ?>

            <?php if ($verificadorSabados) : ?>
                <table class="mt-2">
                    <thead>
                        <tr>
                            <th scope="col" colspan="2">Linha: <?= esc($horarios[0]['linha']) ?></th>
                            <th scope="col" colspan="2"><?= esc($horarioSabados[0]['diaSemanal']) ?></th>
                        </tr>
                        <tr>
                            <th scope="col"><?= esc($horarios[0]['cidadeIda']) ?></th>
                            <th scope="col"><?= esc($horarios[0]['cidadeVolta']) ?></th>
                            <th scope="col" colspan="2">Opções</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php foreach ($horarioSabados as $dia2) : ?>
                            <tr>
                                <td><?= esc($dia2['horarioIda']) ?></td>
                                <td><?= esc($dia2['horarioVolta']) ?></td>
                                <td>
                                    <a class="btn btn-warning btn-sm" href="/admin/horarios/<?= $dia2["id"] ?>">
                                        ALTERAR
                                    </a>
                                </td>
                                <td>
                                    <a class="btn btn-danger btn-sm" href="javascript:remover(<?= $dia2["id"] ?>)">
                                        EXCLUIR
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif ?>

            <?php if ($verificadorDomingos) : ?>
                <table class="mt-2">
                    <thead>
                        <tr>
                            <th scope="col" colspan="2">Linha: <?= esc($horarios[0]['linha']) ?></th>
                            <th scope="col" colspan="2"><?= esc($horarioDomingosFeriados[0]['diaSemanal']) ?></th>
                        </tr>
                        <tr>
                            <th scope="col"><?= esc($horarios[0]['cidadeIda']) ?></th>
                            <th scope="col"><?= esc($horarios[0]['cidadeVolta']) ?></th>
                            <th scope="col" colspan="2">Opções</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php foreach ($horarioDomingosFeriados as $dia3) : ?>
                            <tr>
                                <td><?= esc($dia3['horarioIda']) ?></td>
                                <td><?= esc($dia3['horarioVolta']) ?></td>
                                <td>
                                    <a class="btn btn-warning btn-sm" href="/admin/horarios/<?= $dia3["id"] ?>">
                                        ALTERAR
                                    </a>
                                </td>
                                <td>
                                    <a class="btn btn-danger btn-sm" href="javascript:remover(<?= $dia3["id"] ?>)">
                                        EXCLUIR
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif ?>
        </div>
    <?php endif ?>



</div>

<div class="modal fade" id="formulario" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Adicionar Horarios</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <?= form_open(base_url("admin/horarios/salvar")) ?>
            <div class="modal-body">
                <div class="form-group">
                    <label for="id">ID:</label>
                    <input type="text" class="form-control" id="id" name="id" value="<?= $id ?>" readonly>
                </div>

                <div class="form-group">
                    <label for="diaSemanal">Dia semanal:</label>
                    <select class="form-control" id="diaSemanal" name="diaSemanal" required>
                        <option value="DIAS UTEIS">Dias uteis</option>
                        <option value="SÁBADOS">Sábados</option>
                        <option value="DOMINGOS E FERIADOS">Domingos e feriados</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="horarioIda">Horario ida</label>
                    <input type="text" class="form-control" id="horarioIda" name="horarioIda" placeholder="00:00:00" value="<?= $horarioIda ?>" required>
                </div>

                <div class="form-group">
                    <label for="horarioVolta">Horario volta</label>
                    <input type="text" class="form-control" id="horarioVolta" name="horarioVolta" placeholder="00:00:00" value="<?= $horarioVolta ?>" required>
                </div>

                <div class="form-group">
                    <label for="fkLinha" class="form-label">Selecione uma linha:</label>
                    <select class="form-select" id="fkLinha" name="fkLinha">
                        <?php if ($fkLinha != "") : ?>
                            <option value="<?= $fkLinha  ?>" selected><?= $fkLinha ?></option>
                        <?php elseif (isset($linhaRequisitada)) : ?>
                            <option value="<?= $linhaRequisitada  ?>" selected><?= $linhaRequisitada ?></option>
                        <?php else : ?>
                            <?php foreach ($linhas as $linha) : ?>
                                <option value="<?= $linha['id']  ?>" selected><?= $linha['linha'] ?></option>
                            <?php endforeach ?>
                        <?php endif ?>
                    </select>
                </div>



                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                    <button type="submit" class="btn btn-primary">Salvar</button>
                </div>
                <?= form_close() ?>
            </div>
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

        link.setAttribute("href", `/admin/horarios/remover/${id}`);

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
<?php if (isset($horarioAlterar)) : ?>
    <script>
        abrirForm();
    </script>
<?php endif; ?>
<?php $this->endSection() ?>