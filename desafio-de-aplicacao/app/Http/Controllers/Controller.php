<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    // public function homepage()
    // {
    //     $variavelQualquer = "Lucas";

    //     return view( 'welcome', [
    //         "title" => $variavelQualquer
    //     ]);
    // }

    /**
     * Exibir a view cadastro -> Responsável pelo cadastro de usuário para
     * quem está fora do sistema (através da tela de login)
     * =========================================================================
     */
    public function cadastrar()
    {
        return view('user.cadastro');
    }

    /**
     * Exibir a view login -> Responsável pelo login no sistema
     * =========================================================================
     */
    public function fazerLogin()
    {
        return view('user.login');
    }

    /**
     * Exibir a view login -> Responsável pelo login no sistema
     * =========================================================================
     */
    // public function recuperarSenha()
    // {
    //     return view('user.recuperar-senha');
    // }
}
