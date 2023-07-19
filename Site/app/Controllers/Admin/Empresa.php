<?php

namespace App\Controllers\Admin;
use App\Controllers\BaseController;
use App\Models\CidadeModel;
use App\models\EmpresaModel;
use App\Models\EstadoModel;

class Empresa extends BaseController
{

    public function empresa($id = 0) {
        $empresaModel = new EmpresaModel();
        $estadoModel = new EstadoModel();
        $empresa["empresa"]  = $empresaModel->findAll();
        $empresa["estados"] = $estadoModel->findAll();
        return view('admin/empresa', $empresa);
    }

    public function salvar() {
        $modelEmpresa = new EmpresaModel();
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
            if($modelEmpresa->save($dadosEnviados)){
                session()->setFlashdata("tipo", "success");
                session()->setFlashdata("mensagem", "Salvo com Sucesso!!");
            } else{
                session()->setFlashdata("tipo", "danger");
                session()->setFlashdata("mensagem", "Falha ao salvar!");
            }
            return redirect()->to(base_url("admin/empresa"));
    }

    public function salvarLocal() {
        $modelCidade = new CidadeModel();
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
            if($modelCidade->save($dadosEnviados)){
                session()->setFlashdata("tipo", "success");
                session()->setFlashdata("mensagem", "Salvo com Sucesso!!");
            } else{
                session()->setFlashdata("tipo", "danger");
                session()->setFlashdata("mensagem", "Falha ao salvar!");
            }
            return redirect()->to(base_url("admin/empresa"));
    }
}

?>