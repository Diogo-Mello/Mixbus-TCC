<?php

namespace App\Controllers\Admin;
use App\Controllers\BaseController;
use App\Models\EmpresaModel;

class Painel extends BaseController
{
    public function painel() {
        $modelEmpresa = new EmpresaModel();
        $empresa['dados'] = $modelEmpresa->findAll();
        return view('admin/painel', $empresa);
    }
}

?>