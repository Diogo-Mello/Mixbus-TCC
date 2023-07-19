<?php

namespace App\Models;

// use Exception;
use CodeIgniter\Model;

class SuporteModel extends Model {

    protected $table = "suporte";
    protected $primaryKey = "id";
    protected $useAutoIncrement = true;
    protected $allowedFields = ["descricao", "resposta", "resolvido"];

    public function listarSuporte(){
        $builder = $this->db->table("suporte s");
        $builder->select("s.id 'ID Suporte', s.descricao, u.id 'ID Usuario', s.resposta");
        $builder->join("usuario u", "u.id = s.fkUsuario");
        $query = $builder->get();
        return $query->getResult();
    }

    public function listarSuporteApp($id){
        // $builder = $this->db->table("suporte s");
        // $builder->select("s.id 'ID Suporte', s.descricao, u.id 'ID Usuario', s.resposta");
        // $builder->join("usuario u", "u.id = s.fkUsuario");
        // $query = $builder->get();
        // return $query->getResult();

        return $this->db->query("
        SELECT s.descricao 'descricao', s.resposta 'resposta', s.resolvido 'status' FROM suporte s 
        INNER JOIN usuario u ON u.id = s.fkUsuario
        WHERE s.fkUsuario = ?", [$id])->getResultArray();
    }

    public function pedidoSuporteApp($descricao, $fkUsuario) {
        $this->db->query("
        INSERT INTO suporte (id, descricao, resposta, resolvido, fkUsuario) VALUES 
        (0, ?, '', 0, $fkUsuario)", [$descricao]);
        return true;
    }

    public function listarSuporteSite(){
        return $this->db->query("SELECT id, descricao, resposta, resolvido FROM suporte;")->getResultArray();
    }
}

?>