<?php

namespace App\Controllers;
use App\Controllers\BaseController;

class Home extends BaseController
{
    public function index()
    {
        $dados["pagina"] = "home";
        return view('inicio', $dados);
    }

    public function login()
    {
        $dados["pagina"] = "login";
        return view('login', $dados);
    }

    // public function cadastrar()
    // {
    //     $dados["pagina"] = "login";
    //     return view('cadastrar', $dados);
    // }

    public function sobre()
    {
        $dados["pagina"] = "sobre";
        return view('sobre', $dados);
    }
}
