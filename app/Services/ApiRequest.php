<?php

namespace App\Services;

use App\Repositories\UserRepository;
use GuzzleHttp\Client;

class ApiRequest
{

    private $repository;
    private $client;

    private $host;
    private $serviceID;
    private $authorization;
    private $baseURI;
    private $headers;

    public function __construct($repository)
    {
        $this->repository  = $repository;

        $this->host = 'https://api2.mlearn.mobi/';
        $this->serviceID = 'qualifica';
        $this->authorization = 'Bearer aSE1gIFBKbBqlQmZOOTxrpgPKgQkgshbLnt1NS3w';
        $this->baseURI = $this->host . "integrator/" . $this->serviceID . "/users";

        $this->headers = [
            'authorization' => $this->authorization,
            'service-id'    => $this->serviceID,
            'app-users-group-id' => 20
        ];

        $this->client = new Client(['headers' => $this->headers]);
    }

    public function getUserByID($id)
    {
        $response = $this->client->request('GET', $this->baseURI . "?external_id=" . $id);
        return $response->getBody()->getContents();
    }

    public function insertUser($data)
    {
        $response = $this->client->request('POST', $this->baseURI, [
            'form_params' => [
                'msisdn'        => $data->msisdn,
                'name'          => $data->name,
                'access_level'  => $data->access_level,
                'password'      => $data->password,
                'external_id'   => $data->id
            ]
        ]);

        return $response->getBody()->getContents();
    }
}
