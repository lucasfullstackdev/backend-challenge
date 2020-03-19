<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Repositories\UserRepository;
use App\Validators\UserValidator;
use App\Services\UserService;

// use GuzzleHttp\Exception\GuzzleException;
// use GuzzleHttp\Client;
// use GuzzleHttp\Psr7\Request;

use App\Services\ApiRequest;

/**
 * Class UsersController.
 *
 * @package namespace App\Http\Controllers;
 */
class UsersController extends Controller
{
    protected $repository;
    protected $validator;

    /**
     * UsersController constructor.
     *
     * @param UserRepository $repository
     * @param UserValidator $validator
     */
    public function __construct(UserRepository $repository, UserService $service)
    {
        $this->repository  = $repository;
        $this->service     = $service;
    }

    /**
     * Exibir a view index -> Responsável pelo cadastro de usuário através 
     * do menu lateral
     * =========================================================================
     */
    public function index()
    {
        return view('user.index');
    }

    /**
     * Exibir a view list -> Responsável pela listagem de todos os usuários
     * =========================================================================
     */
    public function list()
    {
        $users = $this->repository->all();

        return view('user.list', [
            'users' => $users
        ]);
    }

    /**
     * Realizar a exclusão do usuário no Banco de Dados
     * Enviar uma Request [ DELETE ] para a API da mLearn
     * =========================================================================
     */
    public function store(UserCreateRequest $request)
    {
        $store = $this->service->store($request->all());
        
        $client= new ApiRequest($this->repository);
        $client->insertUser($store['data']);

        $user = $client->getUserByID($store['data']->id);

        session()->flash('success', [
            'success' => $store['success'],
            'message' => $store['message']
        ]);
        
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $user,
            ]);
        }

        return view('users.show', compact('user'));
    }

    /**
     * Exibir a view edit -> Responsável pela tela de atualização do usuário
     * =========================================================================
     */
    public function edit($id)
    {
        $user = $this->repository->find($id);

        return view('user.edit', [
            'user' => $user
        ]);
    }

    /**
     * Realizar a atualização dos dados do usuário
     * Enviar um request [ PUT ] para a api da mLearn
     * =========================================================================
     */
    public function update(UserUpdateRequest $request, $id)
    {
        $request = $this->service->update($request->all(), $id);
        
        $client= new ApiRequest($this->repository);
        $client->updateUser( $request['data'], $id );

        session()->flash('success', [
            'success' => $request['success'],
            'message' => $request['message']
        ]);
        
        return redirect()->route('user.list');
    }

    /**
     * Realizar o upgrade do nivel de acesso do usuário
     * Enviar um request [ PUT ] para a api da mLearn
     * =========================================================================
     */
    public function upgrade($id)
    {
        $this->service->upgrade($id);

        $client = $client= new ApiRequest($this->repository);
        $upgrade = $client->upgradeUser($id);

        return redirect()->route('user.list');
    }

    /**
     * Realizar o downgrade do nivel de acesso do usuário
     * Enviar um request [ PUT ] para a api da mLearn
     * =========================================================================
     */
    public function downgrade($id)
    {
        $this->service->downgrade($id);

        $client = $client= new ApiRequest($this->repository);
        $downgrade = $client->downgradeUser($id);

        return redirect()->route('user.list');
    }

   /**
     * Realizar a remoção do usuário
     * Enviar um request [ DELETE ] para a api da mLearn
     * =========================================================================
     */
    public function destroy($id)
    {
        $request = $this->service->destroy($id);

        $client = $client= new ApiRequest($this->repository);
        $destroy = $client->destroyUser($id);

        session()->flash('success', [
            'success' => $request['success'],
            'message' => $request['message']
        ]);

        return redirect()->route('user.list');
    }
}
