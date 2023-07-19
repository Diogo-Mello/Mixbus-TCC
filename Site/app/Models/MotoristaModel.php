<?php

namespace App\Models;

// use Exception;
use CodeIgniter\Model;

class MotoristaModel extends Model
{

    protected $table = "motorista";
    protected $primaryKey = "id";
    protected $useAutoIncrement = true;
    protected $allowedFields = ["matricula", "nome", "cpf", "senha", "fkEmpresa"];

    public function listarMotoristas()
    {
        $builder = $this->db->table("motorista m");
        $builder->select("m.id 'ID', m.matricula 'Matriculo', m.senha 'Senha'");
        $query = $builder->get();
        return $query->getResult();
    }

    public function loginMotorista($matricula, $senha)
    {
        $admin = $this->db->query("SELECT id, nome, senha FROM motorista WHERE matricula=?", [$matricula])->getFirstRow("array");

        if (!$admin) {
            return false;
        }

        if (!password_verify($senha, $admin['senha'])) {
            return false;
        }

        return $admin['id'];
    }

    public function listarMotoristaApp($idMotorista)
    {
        $dadosMotorista = $this->db->query("
        SELECT m.nome 'nome', e.nome 'empresa' FROM motorista m
        INNER JOIN empresa e
        ON m.fkEmpresa = e.id
        WHERE m.id = ?
        ", [$idMotorista])->getFirstRow("array");

        return $dadosMotorista;
    }

    public function listarMotoristaSite()
    {
        return $this->db->query("SELECT m.id, m.matricula, m.nome 'motorista', m.cpf, m.senha, e.nome 'empresa' FROM motorista m INNER JOIN empresa e ON m.fkEmpresa = e.id;")->getResultArray();
    }
}
