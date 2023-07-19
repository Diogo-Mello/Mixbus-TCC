<?php

namespace App\Models;

// use Exception;
use CodeIgniter\Model;
use Exception;

class UsuarioModel extends Model {

    protected $table = "usuario";
    protected $primaryKey = "id";
    protected $useAutoIncrement = true;
    protected $allowedFields = ["nome", "email", "senha", "dataNascimento", "telefone"];

    public function cadastrar($nome, $email, $senha){

        // Checar se já existe algum usuário com o e-mail digitado
        $checagem = $this->db->query("SELECT email FROM usuario WHERE email=?", [$email])->getFirstRow("array");
        
        if($checagem) {
            return false;
        }
        // Criar hash da senha
        $hash = password_hash($senha, PASSWORD_DEFAULT);
        $this->save(["nome"=>$nome, "email"=>$email, "senha"=>$hash]);

        return true;
        // Fazer cadastro
    }

    public function logar($email, $senha){
        // Criar QUERY
        $admin = $this->db->query("SELECT id, nome, senha FROM usuario WHERE email=?", [$email])->getFirstRow("array");

        if(!$admin) {
            return false;
        }

        if(!password_verify($senha, $admin["senha"])) {
            return false;
        }

        return ['id' => $admin["id"], 'nome' => $admin["nome"]];

    }

    public function alterarSenhaApp($id, $senhaAntiga, $senhaNova) {
        $usuario =  $this->db->query("SELECT id, senha FROM usuario WHERE id=?", [$id])->getFirstRow("array");

        if (!$usuario) {
            return false;
        } 

        if (!password_verify($senhaAntiga, $usuario['senha'])) {
            return false;
        }

        $hash = password_hash($senhaNova, PASSWORD_DEFAULT);

        $data = [
            'senha' => $hash
        ];

        $this->update($id, $data);

        return true;
    }

    public function excluirContaApp($id, $senha) {
        $usuario = $this->find($id);

        if(!password_verify($senha, $usuario['senha']))
        {
            return false;
        }

        return $this->delete($id);
    }
}
