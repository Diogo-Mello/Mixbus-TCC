<?php $this->extend('admin/template') ?>

<?php $this->section('css') ?>
<link rel="stylesheet" href="../../css/empresa.css">
<?php $this->endSection() ?>

<?php $this->section('conteudo') ?>

<div id="container" class="mt-5">
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nome</th>
                <th scope="col">CNPJ</th>
                <th scope="col">Telefone</th>
                <th scope="col">Email</th>
                <th scope="col">Logo</th>
                <th scope="col">Opções</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($empresa as $empresa) : ?>
                <tr>
                    <th scope="row"><?= $empresa["id"] ?></th>
                    <td><?= esc($empresa["nome"]) ?></td>
                    <td><?= esc($empresa["cnpj"]) ?></td>
                    <td><?= esc($empresa["telefone"]) ?></td>
                    <td><?= esc($empresa["email"]) ?></td>
                    <td><img id="img" src="<?= esc($empresa["logo"]) ?>"></td>
                    <td>
                        <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#formulario">
                            Alterar
                        </button>

                        <br>

                        <button type="button" class="btn btn-primary mt-1" data-bs-toggle="modal" data-bs-target="#local">
                            Adicionar locais
                        </button>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>


<div class="modal fade" id="formulario" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Adicionar Empresas</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <?= form_open(base_url("/admin/empresa/salvar")) ?>
            <div class="modal-body">
                <div class="form-group">
                    <label for="id">ID:</label>
                    <input type="text" class="form-control" id="id" name="id" value="<?= $empresa['id'] ?>" readonly>
                </div>
                <div class="form-group">
                    <label for="nome">Nome:</label>
                    <input type="text" class="form-control" id="nome" name="nome" placeholder="Nome" value="<?= $empresa['nome']  ?>" required>
                </div>
                <div class="form-group">
                    <label for="cnpj">CNPJ:</label>
                    <input type="text" class="form-control" id="cnpj" name="cnpj" placeholder="99999999999999" value="<?= $empresa['cnpj'] ?>" min="14" max="14" required>
                    <div class="form-text" id="basic-addon4">Digite somente números.</div>
                </div>

                <div class="form-group">
                    <label for="telefone">Telefone:</label>
                    <input type="text" class="form-control" id="telefone" name="telefone" placeholder="99999999999" value="<?= $empresa['telefone'] ?>" min="11" max="11" required>
                    <div class="form-text" id="basic-addon4">Digite somente números.</div>
                </div>

                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="email@email.com" value="<?= $empresa['email'] ?>" min="14" max="14" required>
                </div>

                <div class="form-group">
                    <label for="senha">Senha:</label>
                    <input type="password" class="form-control" id="senha" name="senha" placeholder="Digite a senha" value="" required>
                    <div class="form-text" id="basic-addon4">Por questões de segurança, digite ou altere sua senha novamente.</div>
                </div>

                <div class="form-group">
                    <label for="ativo">Ativo:</label>
                    <select class="form-select" id="ativo" name="ativo">
                        <option value="1">Sim</option>
                        <option value="0">Não</option>
                    </select>
                    <div class="form-text" id="basic-addon4">Altere para mostrar se a empresa está funcionando ou não.</div>
                </div>

                <div class="form-group">
                    <label for="logo">Logo:</label>
                    <input type="text" class="form-control" id="logo" name="logo" placeholder="Coloque o link da logo" value="<?= $empresa['logo'] ?>" required>
                    <div class="form-text" id="basic-addon4">Suba somente o link online da logo.</div>
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

<div class="modal fade" id="local" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Adicionar Empresas</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <?= form_open(base_url("/admin/empresa/salvarlocal")) ?>
            <div class="modal-body">
                <div class="form-group">
                    <label for="id">ID:</label>
                    <input type="text" class="form-control" id="id" name="id" value="" readonly>
                </div>
                <div class="form-group">
                    <label for="nome">Local:</label>
                    <input type="text" class="form-control" id="nome" name="nome" placeholder="Nome" value="" required>
                </div>

                <div class="form-group">
                    <label for="fkEstado" class="form-label">Estado:</label>
                    <select class="form-select" id="fkEstado" name="fkEstado">
                        <?php foreach ($estados as $estado) : ?>
                            <option value="<?= $estado['id'] ?>" selected><?= esc($estado["nome"]) ?></option>
                        <?php endforeach; ?>
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



<?php $this->endSection() ?>