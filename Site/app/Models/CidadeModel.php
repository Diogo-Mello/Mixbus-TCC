<?php

namespace App\Models;

// use Exception;
use CodeIgniter\Model;
use Exception;

class CidadeModel extends Model {

    protected $table = "cidade";
    protected $primaryKey = "id";
    protected $useAutoIncrement = true;
    protected $allowedFields = ["nome", "fkEstado"];

}
?>