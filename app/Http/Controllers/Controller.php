<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function homepage()
    {
        $variavelQualquer = "Lucas";

        return view( 'welcome', [
            "title" => $variavelQualquer
        ]);
    }

    public function cadastrar()
    {
        echo 'Tela de cadastro';
    }

    /**
     * Method to user login View
     * ===============================================
     */
    public function fazerLogin()
    {
        return view('user.login');
    }

    public function recuperarSenha()
    {
        return view('user.recuperar-senha');
    }
}
