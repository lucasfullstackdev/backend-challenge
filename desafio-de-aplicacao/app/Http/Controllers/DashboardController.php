<?php

namespace App\Http\Controllers;

// use Illuminate\Support\Facades\Hash;

use Illuminate\Http\Request;
use App\Repositories\UserRepository;
use App\Validators\UserValidator;
use Exception;
use Auth;

class DashboardController extends Controller
{

    private $repository;
    private $validator;

    public function __construct(UserRepository $repository, UserValidator $validator)
    {
        $this->repository = $repository;
        $this->validator  = $validator;
    }

    /**
     * Exibir a view dashboard -> Tela principal do sistema
     * =========================================================================
     */
    public function index()
    {
        return view('user.dashboard');
    }

    /**
     * Realizar a verificação das credenciais de acess
     * Informar o erro em caso de Falha
     * Redirecionar para a dashboard em caso de sucesso
     * =========================================================================
     */
    public function auth(Request $request)
    {
        $data = [
            "msisdn"    => $request->get('username'),
            "password"  => $request->get('password')
        ];
        
        try
        {
            if( env('PASSWORD__HASH') ){
                // $pass = bcrypt( $data['msisdn'] );
                // $user = $this->repository->findWhere([ 'msisdn' => $request->get('username') ])->first();
                // $tst = Auth::attempt( $data, false );
                // dd( $tst );

                // return redirect()->route( $user ? 'user.dashboard': 'user.login' );
            } else {
                $user = $this->repository->findWhere([ 'msisdn' => $request->get('username') ])->first();

                if ( !$user )
                    throw new Exception("O e-mail informado é inválido", 1);
                    
                if ( $user->password != $request->get('password') )
                    throw new Exception("A senha informada é inválida", 1);
                
                Auth::login($user);
            }
            
            return redirect()->route('user.dashboard');
        } catch (Exception $e)
        {
            return $e->getMessage();
        }
    }

}
