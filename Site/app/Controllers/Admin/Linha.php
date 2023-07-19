<?php

namespace App\Controllers\Admin;
use App\Controllers\BaseController;
use App\Models\LinhaModel;
use App\Models\CidadeModel;
use App\Models\LocalizacaoModel;

class Linha extends BaseController
{
    public function linhas($id = 0) {
        $linhaModel = new LinhaModel();
        $cidadeModel = new CidadeModel();
        $linhas["linhas"]  = $linhaModel->listarLinhasSite();
        $linhas["cidades"] = $cidadeModel->findAll();

        if($id != 0){
            $linhaId = $linhaModel->find($id);
            if(!$linhaId){
                session()->setFlashdata("tipo", "danger");
                session()->setFlashdata("mensagem", "Linha não encontrado");
                return redirect()->to(base_url("/admin/linhas"));
            }
            $linhas["linhaAlterar"] = $linhaId;
        }
        return view('admin/linhas', $linhas);
    }

    public function remover($id){
        $linhaModel = new LinhaModel();
        if($linhaModel->delete($id)){
            session()->setFlashdata("tipo", "success");
            session()->setFlashdata("mensagem", "Item excluido com Sucesso!!");
        }else {
            session()->setFlashdata("tipo", "danger");
            session()->setFlashdata("mensagem", "Falha ao excluir!");
        }
        return redirect()->to("/admin/linhas");
    }

    public function salvar() {
        $modelLinha = new LinhaModel();
        $modelLocalizacao = new LocalizacaoModel();
        $dadosEnviados = $this->request->getPost();

        $regras = [
            'linha'     => 'required',
            'preco'      => 'required|decimal'
        ];
        
        $mensagem = [
            'linha'     => [
                'required'      => 'A linha é obrigatória'
            ],
            'preco'     => [
                'required'      => 'O preço é obrigatório',
                'decimal'       => 'Digite um preço válido'
            ]
        ];
        
        if($this->validate($regras, $mensagem)){

            if($modelLinha->save($dadosEnviados)){
                session()->setFlashdata("tipo", "success");
                session()->setFlashdata("mensagem", "Salvo com Sucesso!!");

                $resultado = $modelLinha->findAll();
                $resultado = end($resultado);

                $dadosLocalizacao = [
                    'id' => '',
                    'fkLinha' => $resultado['id']
            ];
                $modelLocalizacao->save($dadosLocalizacao);

            }else{
                session()->setFlashdata("tipo", "danger");
                session()->setFlashdata("mensagem", "Falha ao salvar!");
            }
            return redirect()->to(base_url("admin/linhas"));
        }else{
            session()->setFlashdata("validacao" , $this->validator);
            session()->setFlashdata("linha" , $dadosEnviados);
            return redirect()->to(base_url("admin/linhas"));
        }
    }
}
