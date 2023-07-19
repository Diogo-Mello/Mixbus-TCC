<?php

namespace App\Models;

// use Exception;
use CodeIgniter\Model;
use Exception;

class EmpresaModel extends Model {

    protected $table = "empresa";
    protected $primaryKey = "id";
    protected $useAutoIncrement = true;
    protected $allowedFields = ["nome", "cnpj", "telefone", "email", "senha", "ativo", "logo"];

    public function cadastrar($nome, $cnpj, $telefone, $email, $senha){

        // Checar se já existe algum usuário com o e-mail digitado
        $checagem = $this->db->query("SELECT email FROM empresa WHERE email=?", [$email])->getFirstRow("array");

        if($checagem) {
            throw new Exception("Este Email já está cadastrado");
            return;
        }
        // Criar hash da senha
        $hash = password_hash($senha, PASSWORD_DEFAULT);
        return $this->save(["nome"=>$nome, "cnpj"=>$cnpj, "telefone"=>$telefone, "email"=>$email, "telefone"=>$telefone, "senha"=>$hash]);
        // Fazer cadastro
    }

    public function logar($email, $senha){
        // Criar QUERY
        $admin = $this->db->query("SELECT id, nome, senha FROM empresa WHERE email=?", [$email])->getFirstRow("array");

        if(!$admin) {
            throw new Exception("E-mail ou senha inválida");
        }

        if(!password_verify($senha, $admin["senha"])) {
            throw new Exception("E-mail ou senha inválida");
        }

        return $admin["id"];

    }

    public function listarEmpresaSite(){
        return $this->db->query("SELECT id, nome, cnpj, telefone, email, logo FROM empresa;")->getResultArray();
    }
}

?>