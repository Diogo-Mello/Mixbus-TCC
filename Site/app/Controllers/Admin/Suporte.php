<?php

namespace App\Controllers\Admin;
use App\Controllers\BaseController;
use App\Models\SuporteModel;


class Suporte extends BaseController
{

    public function suporte($id = 0) {
        $suporteModel = new SuporteModel();
        $suporte["suporte"] = $suporteModel->listarsuporteSite();

        if($id != 0) {
            $suporteId = $suporteModel->find($id);
            if(!$suporteId){
                session()->setFlashdata("tipo", "danger");
                session()->setFlashdata("mensagem", "Linha não encontrado");
                return redirect()->to(base_url("/admin/suporte"));
            }
            $suporte["suporteBusca"] = $suporteId;
        }

        return view('admin/suporte', $suporte);
    }

    public function remover($id){
        $suporteModel = new SuporteModel();
        if($suporteModel->delete($id)){
            session()->setFlashdata("tipo", "success");
            session()->setFlashdata("mensagem", "Item excluido com Sucesso!!");
        }else {
            session()->setFlashdata("tipo", "danger");
            session()->setFlashdata("mensagem", "Falha ao excluir!");
        }
        return redirect()->to("/admin/suporte");
    }

    public function salvar() {
        $modelSuporte = new SuporteModel();
        $dadosEnviados = $this->request->getPost();

        $regras = [
            'resposta'      => 'required'
        ];
        
        $mensagem = [
            'resposta'     => [
                'required'      => 'A resposta é obrigátoria'
            ]
        ];
        
        if($this->validate($regras, $mensagem)){
            if($modelSuporte->save($dadosEnviados)){
                session()->setFlashdata("tipo", "success");
                session()->setFlashdata("mensagem", "Salvo com Sucesso!!");
            }else{
                session()->setFlashdata("tipo", "danger");
                session()->setFlashdata("mensagem", "Falha ao salvar!");
            }
            return redirect()->to(base_url("admin/suporte"));
        }else{
            session()->setFlashdata("validacao" , $this->validator);
            session()->setFlashdata("linha" , $dadosEnviados);
            return redirect()->to(base_url("admin/suporte"));
        }
    }


}

?>