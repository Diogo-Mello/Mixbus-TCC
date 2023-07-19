<?php
    $id = '';
    $matricula = '';
    $nome = '';
    $cpf = '';

    if(isset($motorista)){
        $id = $motorista["id"];
        $matricula = $motorista["matricula"];
        $nome = $motorista["nome"];
        $cpf = $motorista["cpf"];
    }
?>

<?php $this->extend('admin/template') ?>

<?php $this->section('css') ?>
<link rel="stylesheet" href="../../css/motoristas.css">
<?php $this->endSection() ?>

<?php $this->section('conteudo') ?>


<div id="container" class="pt-5">
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Matricula</th>
                <th scope="col">Nome</th>
                <th scope="col">CPF</th>
                <th scope="col">Empresa</th>
                <th scope="col">Opções</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($motoristas as $motoristas) : ?>
                <tr>
                    <th scope="row"><?= $motoristas["id"] ?></th>
                    <td><?= esc($motoristas["matricula"]) ?></td>
                    <td><?= esc($motoristas["motorista"]) ?></td>
                    <td><?= esc($motoristas["cpf"]) ?></td>
                    <td><?= esc($motoristas["empresa"]) ?></td>
                    <td>
                        <a class="btn btn-warning" href="/admin/motoristas/<?= $motoristas["id"] ?>">
                            ALTERAR
                        </a>
                        <a class="btn btn-danger" href="javascript:remover(<?= $motoristas["id"] ?>)">
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
                <h1 class="modal-title fs-5" id="exampleModalLabel">Adicionar motorista</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <?= form_open(base_url("admin/motoristas/salvar")) ?>
            <div class="modal-body">
                <div class="form-group">
                    <label for="id">ID:</label>
                    <input type="text" class="form-control" id="id" name="id" value="<?= $id ?>" readonly>
                </div>
                <div class="form-group">
                    <label for="matricula">Matrícula:</label>
                    <input type="text" class="form-control" id="matricula" name="matricula" placeholder="Digite a matrícula" value="<?= $matricula ?>" required min="5" max="5">
                    <div class="form-text" id="basic-addon4">5 digitos.</div>
                </div>
                <div class="form-group">
                    <label for="nome">Nome:</label>
                    <input type="text" class="form-control" id="nome" name="nome" placeholder="Digite o nome" value="<?= $nome ?>" required>
                </div>
                <div class="form-group">
                    <label for="cpf">CPF:</label>
                    <input type="text" class="form-control" id="cpf" name="cpf" placeholder="Digite o CPF" value="<?= $cpf ?>" required>
                    <div class="form-text" id="basic-addon4">Somente números.</div>
                </div>
                <div class="form-group">
                    <label for="senha">Senha de acesso:</label>
                    <input type="password" class="form-control" id="senha" name="senha" min="8" max="20" placeholder="********" required>
                    <div class="form-text" id="basic-addon4">De 8 a 20 digitos.</div>
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

<script defer>
    function remover(id){
        const link = document.getElementById("link-exclusao");
        const modalExclusao =
            new bootstrap.Modal(document.getElementById("confirm"), {});

        link.setAttribute("href", `/admin/motoristas/remover/${id}`);

        modalExclusao.show();
    }

    function abrirForm(){
        const modalForm =
            new bootstrap.Modal(document.getElementById("formulario"), {});
            modalForm.show();
    }
</script>



<?php $this->endSection() ?>

<?php $this->section('conteudoPosterior') ?>
<?php if (isset($motorista)) :?>
        <script>
            abrirForm();
        </script>
<?php endif; ?>
<?php $this->endSection() ?>