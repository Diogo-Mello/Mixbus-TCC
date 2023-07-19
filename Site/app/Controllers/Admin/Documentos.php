<?php

namespace App\Controllers\Admin;
use App\Controllers\BaseController;
use App\Models\LinhaModel;

class Documentos extends BaseController
{
    public function documentacao() {
        $modelLinha = new LinhaModel();
        $documentos['linhas'] = $modelLinha->listarLinhaApp();
        return view('admin/documentos', $documentos);
    }
}

?>