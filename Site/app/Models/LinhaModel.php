<?php

namespace App\Models;

// use Exception;
use CodeIgniter\Model;

class LinhaModel extends Model
{

    protected $table = "linha";
    protected $primaryKey = "id";
    protected $useAutoIncrement = true;
    protected $allowedFields = ["linha", "preco", "fkcidadeIda", "fkCidadeVolta", "fkEmpresa"];

    public function listarCards()
    {
        return $this->db->query("SELECT e.logo 'logo', ci.nome 'cidadeIda', cv.nome 'cidadeVolta', l.preco 'preco', h.fkLinha 'linha' FROM empresa e 
        INNER JOIN linha l
        INNER JOIN horario h
        INNER JOIN cidade ci
        INNER JOIN cidade cv
        ON e.id = l.fkEmpresa
        AND l.id = h.fkLinha
        AND ci.id = l.fkcidadeIda
        AND cv.id = l.fkcidadeVolta
        GROUP BY h.fkLinha
        ")->getResultArray();
    }

    public function listarHorarios($id)
    {
        return $this->db->query("
        SELECT l.linha 'linha',
        h.diaSemanal 'diaSemanal',
        TIME_FORMAT(h.horarioIda, '%H:%i') 'horarioIda',
        TIME_FORMAT(h.horarioVolta, '%H:%i') 'horarioVolta',
        ci.nome 'cidadeIda',
        cv.nome 'cidadeVolta'
        FROM horario h
        INNER JOIN linha l
        INNER JOIN cidade ci
        INNER JOIN cidade cv
        ON h.fkLinha = l.id
        AND l.fkcidadeIda = ci.id
        AND l.fkCidadeVolta = cv.id
        WHERE l.id = ?;
        ", [$id])->getResultArray();
    }

    public function listarLinhasSite(){
        return $this->db->query("SELECT l.id, l.linha, l.preco, ci.nome 'Cidade ida', cv.nome 'Cidade Volta' FROM linha l INNER JOIN cidade ci ON l.fkcidadeIda = ci.id INNER JOIN cidade cv ON l.fkcidadeVolta = cv.id ORDER BY l.id ASC")->getResultArray();
    }

    public function listarLinhaApp(){
        return $this->db->query("SELECT loc.id 'id', l.linha 'linha', ci.nome 'cidadeIda', cv.nome 'cidadeVolta' FROM localizacao loc
        INNER JOIN linha l
        INNER JOIN cidade ci
        INNER JOIN cidade cv
        ON loc.fkLinha = l.id
        AND l.fkCidadeIda = ci.id
        AND l.fkCidadeVolta = cv.id;")->getResultArray();
    }
}
