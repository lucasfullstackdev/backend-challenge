<?php

namespace App\Http\Controllers;

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

    public function index()
    {
        return "Estamos na index(dashboard)";
    }

    public function auth(Request $request)
    {
        $data = [
            "msisdn"    => $request->get('username'),
            "password"  => $request->get('password')
        ];
        
        try
        {

            if( env('PASSWORD__HASH') ){
                Auth::attempt($data, false);
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

        dd($request->all());
    }

}
