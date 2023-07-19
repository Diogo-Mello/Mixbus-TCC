<?php

namespace App\Controllers\Admin;
use App\Controllers\BaseController;
use App\Models\MotoristaModel;


class Motorista extends BaseController
{
    public function motoristas($id = 0) {
        $motoristaModel = new MotoristaModel();
        $motoristas["motoristas"] = $motoristaModel->listarMotoristaSite();

        if($id != 0){
            $motoristaId = $motoristaModel->find($id);
            if(!$motoristaId){
                session()->setFlashdata("tipo", "danger");
                session()->setFlashdata("mensagem", "Motorista não encontrado");
                return redirect()->to(base_url("/admin/motoristas"));
            }
            $motoristas["motorista"] = $motoristaId;
        }
        return view('admin/motoristas', $motoristas);
    }

    public function remover($id){
        $motoristaModel = new MotoristaModel();
        if($motoristaModel->delete($id)){
            session()->setFlashdata("tipo", "success");
            session()->setFlashdata("mensagem", "Item excluido com Sucesso!!");
        }else {
            session()->setFlashdata("tipo", "danger");
            session()->setFlashdata("mensagem", "Falha ao excluir!");
        }
        return redirect()->to("/admin/motoristas");
    }

    public function salvar() {
        $modelMotorista = new MotoristaModel();
        $dadosEnviados = $this->request->getPost();

        $regras = [
            'matricula'     => 'required',
            'nome'      => 'required|min_length[2]',
            'cpf'   => 'required|min_length[11]|max_length[11]',
            'senha'   => 'required|min_length[8]|max_length[20]'
        ];
        
        $mensagem = [
            'matricula'     => [
                'required'      => 'A matrícula é obrigatória'
            ],
            'nome'      => [
                'required'      => 'O nome é obrigatório',
                'min_length'    => 'Digite um nome válido'
            ],
            'cpf'   => [
                'required'      => 'O CPF é obrigatório'
            ],
            'senha'   => [
                'required'      => 'A senha é obrigatória',
                'min_length'    => 'Digite uma senha válida',
                'max_length'    => 'Digite uma senha válida',
            ]
        ];
        
        if($this->validate($regras, $mensagem)){
            $dadosEnviados['senha'] = password_hash($dadosEnviados['senha'], PASSWORD_DEFAULT);
            if($modelMotorista->save($dadosEnviados)){
                session()->setFlashdata("tipo", "success");
                session()->setFlashdata("mensagem", "Salvo com Sucesso!!");
            }else{
                session()->setFlashdata("tipo", "danger");
                session()->setFlashdata("mensagem", "Falha ao salvar!");
            }
            return redirect()->to(base_url("admin/motoristas"));
        }else{
            session()->setFlashdata("validacao" , $this->validator);
            session()->setFlashdata("motorista" , $dadosEnviados);
            return redirect()->to(base_url("admin/motoristas"));
        }
    }
}

?>