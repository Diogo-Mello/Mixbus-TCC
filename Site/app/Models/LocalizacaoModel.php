<?php

namespace App\Models;

// use Exception;
use CodeIgniter\Model;

class LocalizacaoModel extends Model {

    protected $table = "localizacao";
    protected $primaryKey = "id";
    protected $useAutoIncrement = true;
    protected $allowedFields = ["latitude", "longitude", "fkLinha"];

    public function localizacaoLinha(){
        return $this->db->query("
        SELECT l.linha 'linha', loc.latitude 'latitude', loc.longitude 'longitude' 
        FROM localizacao loc
        INNER JOIN linha l
        ON loc.fkLinha = l.id
        ")->getResultArray();
    }

    // SELECT lo.latitude, lo.longitude, l.fkLocalizacao FROM localizacao lo INNER JOIN linha l ON l.fkLocalizacao = lo.id;
}

?>