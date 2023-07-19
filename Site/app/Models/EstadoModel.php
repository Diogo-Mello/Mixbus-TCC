<?php

namespace App\Models;

// use Exception;
use CodeIgniter\Model;
use Exception;

class EstadoModel extends Model {

    protected $table = "estado";
    protected $primaryKey = "id";
    protected $useAutoIncrement = true;
    protected $allowedFields = ["nome", "sigla"];

}
?>