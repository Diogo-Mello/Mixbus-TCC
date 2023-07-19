<?php

namespace App\Controllers\Admin;
use App\Controllers\BaseController;
use App\Models\HorariosModel;
use App\Models\LinhaModel;

class Horario extends BaseController
{
    public function horarios($id = 0) {
        $horariosModel = new HorariosModel();
        $linhasModel = new LinhaModel();

        $horarios['linhas'] = $linhasModel->listarLinhaApp();
        
        if($this->request->getPost('linha')) {
            $linhaRequisitada = $this->request->getPost('linha');
            session()->set('linhaRequisitada', $linhaRequisitada);
            $horarios['horarios'] = $horariosModel->listarHorarioSite($linhaRequisitada);
            $horarios["linhaRequisitada"] = $linhaRequisitada;
        }

        if($id != 0){
            $horariosId = $horariosModel->find($id);
            $linhaRequisitada = session()->get('linhaRequisitada');
            $horarios['horarios'] = $horariosModel->listarHorarioSite($linhaRequisitada);
            if(!$horariosId){
                session()->setFlashdata("tipo", "danger");
                session()->setFlashdata("mensagem", "Horario não encontrado");
                return redirect()->to(base_url("/admin/horarios"));
            }
            $horarios["horarioAlterar"] = $horariosId;
        }

        return view('admin/horarios', $horarios);
    }
    
    public function remover($id){
        $horarioModel = new HorariosModel();
        if($horarioModel->delete($id)){
            session()->setFlashdata("tipo", "success");
            session()->setFlashdata("mensagem", "Item excluido com Sucesso!!");
        }else {
            session()->setFlashdata("tipo", "danger");
            session()->setFlashdata("mensagem", "Falha ao excluir!");
        }
        return redirect()->to("/admin/horarios");
    }

    public function salvar() {
        $modelHorario = new HorariosModel();
        $dadosEnviados = $this->request->getPost();

        // $regras = [
        //     'linha'     => 'required',
        //     'preco'      => 'required|decimal'
        // ];
        
        // $mensagem = [
        //     'linha'     => [
        //         'required'      => 'A linha é obrigatória'
        //     ],
        //     'preco'     => [
        //         'required'      => 'O preço é obrigatório',
        //         'decimal'       => 'Digite um preço válido'
        //     ]
        // ];
        
        // if($this->validate($regras, $mensagem)){
            if($modelHorario->save($dadosEnviados)){
                session()->setFlashdata("tipo", "success");
                session()->setFlashdata("mensagem", "Salvo com Sucesso!!");
            }else{
                session()->setFlashdata("tipo", "danger");
                session()->setFlashdata("mensagem", "Falha ao salvar!");
            }
            
            return redirect()->to(base_url("admin/horarios"));
        }
        // else{
        //     session()->setFlashdata("validacao" , $this->validator);
        //     session()->setFlashdata("linha" , $dadosEnviados);
        //     return redirect()->to(base_url("admin/linhas"));
        // }
    // }
}

?>