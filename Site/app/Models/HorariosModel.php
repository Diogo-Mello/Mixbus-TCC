<?php

namespace App\Models;

// use Exception;
use CodeIgniter\Model;

class HorariosModel extends Model
{

    protected $table = "horario";
    protected $primaryKey = "id";
    protected $useAutoIncrement = true;
    protected $allowedFields = ["diaSemanal", "horarioIda", "fkObsIda", "horarioVolta", "fkObsVolta", "fkLinha"];

    public function listarHorarioSite($id){
        return $this->db->query("
        SELECT h.id 'id', l.linha 'linha',
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
        WHERE l.id = ?
        ORDER BY horarioIda ASC
        ", [$id])->getResultArray();
    }

    public function SelecionarLinhasSite($linhas){
        return $this->db->query("", [$linhas])->getResultArray();

    }
}
