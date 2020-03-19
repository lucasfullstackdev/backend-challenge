<?php

namespace App\Services;

use Prettus\Validator\Contracts\ValidatorInterface;
use App\Repositories\UserRepository;
use App\Validators\UserValidator;

class UserService
{

    private $repository;
    private $validator;

    public function __construct( UserRepository $repository, UserValidator $validator )
    {
        $this->repository  = $repository;
        $this->validator   = $validator;
    }

    public function store($data)
    {
        $data['password'] = env('PASSWORD__HASH') ? bcrypt($data['password']): $data['password'];

        try {
            $this->validator->with($data)->passesOrFail(ValidatorInterface::RULE_CREATE);
            $usuario = $this->repository->create($data);

            return [
                'success' => true,
                'message' => 'Usuário Cadastrado',
                'data'    => $usuario
            ];
        } catch (\Exception $e) {
            return [ 'success' => false, 'message' => $e->getMessage() ];
        }
    }
    
    public function update($data, $id){
        try {
            $this->validator->with($data)->passesOrFail(ValidatorInterface::RULE_UPDATE);
            $usuario = $this->repository->update($data, $id);

            return [
                'success' => true,
                'message' => 'Usuário Atualizado',
                'data'    => $usuario
            ];
        } catch (\Exception $e) {
            return [ 'success' => false, 'message' => $e->getMessage() ];
        }
    }

    public function upgrade($id)
    {
        $user = $this->repository->find($id);
        $data = [
            'msisdn'        => $user->msisdn,
            'name'          => $user->name,
            'access_level'  => 'premium',
            'password'      => $user->password,
            'external_id'   => $user->id
        ];

        $this->repository->update($data, $id);
    }

    public function downgrade($id)
    {
        $user = $this->repository->find($id);
        $data = [
            'msisdn'        => $user->msisdn,
            'name'          => $user->name,
            'access_level'  => 'free',
            'password'      => $user->password,
            'external_id'   => $user->id
        ];

        $this->repository->update($data, $id);
    }



    public function destroy($user_id){
        try {
            $this->repository->delete($user_id);

            return [
                'success' => true,
                'message' => 'Usuário Removido',
                'data'    => null
            ];
        } catch (\Exception $e) {
        }
    }

}