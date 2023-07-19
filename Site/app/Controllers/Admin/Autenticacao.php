<?php

namespace App\Controllers\Admin;
use App\Controllers\BaseController;
use App\Models\EmpresaModel;
use Exception;

class Autenticacao extends BaseController
{
    public function cadastrar(){
        $nome = $this->request->getPost("nomeEmpresa");
        $cnpj = $this->request->getPost("cnpj");
        $telefone = $this->request->getPost("telefone");
        $email = $this->request->getPost("email");
        $senha = $this->request->getPost("senha");

        $regras = [
            'nome' => 'required|min_length[2]',
            'cnpj' => 'required|min_length[18]',
            'telefone' => 'required|min_length[14]',
            'email' => 'required',
            'senha' => 'required|min_length[8]'
        ];

        $adminModel = new EmpresaModel();
        try {
            if($adminModel->cadastrar($nome, $cnpj, $telefone, $email, $senha)){
                session()->setFlashdata("aviso", "Sucesso ao cadastrar");
                return redirect()->to(base_url("/login"));
            } else {
            session()->setFlashdata("aviso", "Erro ao cadastrar");
            return redirect()->to(base_url("/cadastrar"));
            }
        } catch (Exception $erro) {
            session()->setFlashdata("aviso", $erro->getMessage());
            return redirect()->to(base_url("/cadastrar"));
        }
        
    }

    public function logar(){
        try {
            $email = $this->request->getPost("email");
            $senha = $this->request->getPost("senha");

            $adminModel = new EmpresaModel();
            $idEmpresa = $adminModel->logar($email, $senha);
    
            session()->set("idEmpresa", $idEmpresa);
            return redirect()->to(base_url("/admin/painel"));

        } catch (Exception $erro) {
            session()->setFlashdata("aviso", $erro->getMessage());
            return redirect()->to(base_url("/login"));
        }
    }

    public function sair(){
        $session = session();
        $session->destroy();
        return redirect()->to(base_url("login"));
    }
}

?>