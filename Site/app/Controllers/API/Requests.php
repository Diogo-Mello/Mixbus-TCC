<?php

namespace App\Controllers\Api;

use App\Models\LinhaModel;
use App\Models\LocalizacaoModel;
use App\Models\MotoristaModel;
use App\Models\SuporteModel;
use App\Models\UsuarioModel;
use CodeIgniter\RESTful\ResourceController;

class Requests extends ResourceController
{

    public function alterarSenhaApp()
    {
        $dadosPuxados = $this->request->getJSON();
        $usuarioModel = new UsuarioModel();

        $resultado = $usuarioModel->alterarSenhaApp($dadosPuxados->id, $dadosPuxados->senhaAntiga, $dadosPuxados->senhaNova);

        return $this->response->setJSON($resultado);
    }

    public function excluirContaApp()
    {
        $dadosPuxados = $this->request->getJSON();
        $usuarioModel = new UsuarioModel();

        $resultado = $usuarioModel->excluirContaApp($dadosPuxados->id, $dadosPuxados->senha);

        return $this->response->setJSON($resultado);
    }

    public function listarDadosApp()
    {
        $dadosPuxados = $this->request->getJSON();
        $usuarioModel = new UsuarioModel();

        $dados = $usuarioModel->find($dadosPuxados->id);
        
        return $this->response->setJSON($dados);
    }

    public function listarCards()
    {
        $linhaModel = new LinhaModel();
        return $this->respond($linhaModel->listarCards());
    }

    public function listarSuporte()
    {
        $suporteModel = new SuporteModel();
        return $this->respond($suporteModel->listarSuporte());
    }

    public function listarSuporteApp() {
        $id = $this->request->getJSON();

        $suporteModel = new SuporteModel();
        $suportes = $suporteModel->listarSuporteApp($id->id);
        return $this->respond($suportes);
    }

    public function pedidoSuporteApp() {
        $dados = $this->request->getJSON();

        $suporteModel = new SuporteModel();
        $suportes = $suporteModel->pedidoSuporteApp($dados->descricao, $dados->fkUsuario);
        return $this->respond($suportes);
    }

    public function localizacaoLinha()
    {
        $linhaModel = new LocalizacaoModel();
        return $this->respond($linhaModel->localizacaoLinha());
    }

    public function cadastroLocalizacao()
    {
        $modelLocalizacao = new LocalizacaoModel();
        $dadosPuxados = $this->request->getJSON();

        if ($modelLocalizacao->save($dadosPuxados)) {
            $this->response->setStatusCode(201); // definir o código de status como 201 (Created)
            $this->response->setJSON(['success' => true]); // enviar a resposta em formato JSON
        } else {
            $this->response->setStatusCode(500); // definir o código de status como 500 (Internal Server Error)
            $this->response->setJSON(['success' => false, 'message' => 'Erro ao salvar dados']);
        }
    }

    public function loginMotorista()
    {
        $resposta = $this->request->getJSON();
        $modelMotorista = new MotoristaModel();

        $idMotorista = $modelMotorista->loginMotorista($resposta->matricula, $resposta->senha);
        return $this->response->setJSON($idMotorista);
    }

    public function listarDadosMotorista(){
        $id = $this->request->getJSON();
        $modelMotorista = new MotoristaModel();
        $dadosMotorista = $modelMotorista->listarMotoristaApp($id->id);
        return $this->response->setJSON($dadosMotorista);
    }

    public function loginUsuario()
    {
        $dados = $this->request->getJSON();
        // echo json_encode($dados);
        //     exit;
        $modelUsuario = new UsuarioModel();

        $idUsuario = $modelUsuario->logar($dados->email, $dados->senha);

        return $this->response->setJSON($idUsuario);
    }

    public function cadastroUsuario()
    {
        $dados = $this->request->getJSON();

        $modelUsuario = new UsuarioModel();

        $resposta = $modelUsuario->cadastrar($dados->nome, $dados->email, $dados->senha);

        return $this->response->setJSON($resposta);
    }

    public function listarMotorista()
    {
        $linhaModel = new MotoristaModel();
        return $this->respond($linhaModel->listarMotoristas());
    }

    public function listarHorarios()
    {
        $modelLinha = new LinhaModel();
        $id = $this->request->getJSON('id');
        return $this->respond($modelLinha->listarHorarios($id));
    }

    public function listarLinhaApp()
    {
        $modelLinha = new LinhaModel();
        $resultado = $modelLinha->listarLinhaApp();
        return $this->response->setJSON($resultado);
    } 

    public function negada()
    {
        $message = ['Sem permissão para acessar a API'];
        return $this->respond($message);
    }
}
