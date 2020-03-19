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
        return json_decode( $response->getBody()->getContents() );
    }

    public function insertUser($data)
    {
        return $this->sendRequest('POST', $this->baseURI, $data );
    }

    public function updateUser($data, $id)
    {
        return $this->sendRequest('PUT', $this->baseURI . "/" . $this->getApiUserId($id), $data);
    }

    public function upgradeUser($id)
    {
        $baseURI = $this->baseURI . "/" . $this->getApiUserId($id) . "/upgrade";
        $response = $this->client->request( 'PUT', $baseURI );
        
        return json_decode( $response->getBody()->getContents() );
    }

    public function downgradeUser($id)
    {
        $baseURI = $this->baseURI . "/" . $this->getApiUserId($id) . "/downgrade";
        $response = $this->client->request( 'PUT', $baseURI );
        
        return json_decode( $response->getBody()->getContents() );
    }

    public function destroyUser($id)
    {
        $baseURI = $this->baseURI . "/" . $this->getApiUserId($id);
        $response = $this->client->request( 'DELETE', $baseURI );
        
        return json_decode( $response->getBody()->getContents() );
    }

    private function getApiUserId($id)
    {
        return $this->getUserByID($id)->data->id;
    }
    
    private function sendRequest($method, $baseURI, $data)
    {
        $response = $this->client->request( $method, $baseURI, [
            'form_params' => [
                'msisdn'        => $data->msisdn,
                'name'          => $data->name,
                'access_level'  => $data->access_level,
                'password'      => $data->password,
                'external_id'   => $data->id
            ]
        ]);

        return json_decode( $response->getBody()->getContents() );
    }
}
