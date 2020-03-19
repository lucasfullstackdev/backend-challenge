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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('user.index');
    }

    public function list()
    {
        $users = $this->repository->all();

        return view('user.list', [
            'users' => $users
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  UserCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(UserCreateRequest $request)
    {
        $store = $this->service->store($request->all());

        $client= new ApiRequest($this->repository);
        $tst = $client->insertUser($store['data']);

        $user = $client->getUserByID($store['data']->id);

        session()->flash('success', [
            'success' => $store['success'],
            'message' => $store['message']
        ]);
        
        return redirect()->route('user.index');
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
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = $this->repository->find($id);

        return view('user.edit', [
            'user' => $user
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UserUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(UserUpdateRequest $request, $id)
    {
        $request = $this->service->update($request->all(), $id);
        
        $client= new ApiRequest($this->repository);
        $tst = $client->updateUser( $request['data'], $id );

        session()->flash('success', [
            'success' => $request['success'],
            'message' => $request['message']
        ]);
        
        return redirect()->route('user.list');
    }

    public function upgrade($id)
    {
        $this->service->upgrade($id);

        $client = $client= new ApiRequest($this->repository);
        $upgrade = $client->upgradeUser($id);

        return redirect()->route('user.list');
    }

    public function downgrade($id)
    {
        $this->service->downgrade($id);

        $client = $client= new ApiRequest($this->repository);
        $downgrade = $client->downgradeUser($id);

        return redirect()->route('user.list');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
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
