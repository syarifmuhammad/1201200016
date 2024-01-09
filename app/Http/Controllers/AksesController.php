<?php

namespace App\Http\Controllers;

use GuzzleHttp\Psr7;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Http\Request;

class AksesController extends Controller
{
    private $URL;
    private $token;

    public function __construct()
    {
        $this->URL = 'http://localhost/1201200016/public/api/employees';
        $this->token = '1|qEMjD24JCgDbYRROvRKqCaXjCPLvK8302LkJId9N75fceaa0';
    }

    public function aksesApiGetEmployee()
    {
        try {
            $client = new \GuzzleHttp\Client();
            $response = $client->request('GET', $this->URL, [
                'headers' => [
                    'Accept' => 'application/json',
                    'Authorization' => 'Bearer ' . $this->token
                ]
            ]);
            $result = json_decode($response->getBody()->getContents(), true);
            return $result;
        } catch (ClientException $e) {
            echo Psr7\Message::toString($e->getResponse());
        }
    }

    public function aksesApiGetEmployeeById($id)
    {
        try {
            $client = new \GuzzleHttp\Client();
            $response = $client->request('get', $this->URL . '/' . $id, [
                'headers' => [
                    'Accept' => 'application/json',
                    'Authorization' => 'Bearer ' . $this->token
                ]
            ]);
            $result = json_decode($response->getBody()->getContents(), true);
            return $result;
        } catch (ClientException $e) {
            return json_decode($e->getResponse()->getBody()->getContents(), true);
        }
    }

    public function aksesApiInsertEmployee()
    {
        try {
            $client = new \GuzzleHttp\Client();
            $response = $client->request('POST', $this->URL, [
                'headers' => [
                    'Accept' => 'application/json',
                    'Authorization' => 'Bearer ' . $this->token
                ],
                'json' => [
                    'employeeNumber' => 9999,
                    'lastName' => 'Syarif Hidayatullah',
                    'firstName' => 'Muhammad',
                    'extension' => 'x9999',
                    'email' => 'syarifmuhammad369@gmail.com',
                    'officeCode' => '1',
                    'reportsTo' => 1002,
                    'jobTitle' => 'New President'
                ]
            ]);



            $result = json_decode($response->getBody()->getContents(), true);
            return $result;
        } catch (ClientException $e) {
            return json_decode($e->getResponse()->getBody()->getContents(), true);
        }
    }

    public function aksesApiUpdateEmployee($id)
    {
        try {
            $client = new \GuzzleHttp\Client();
            $response = $client->request('PUT', $this->URL . '/' . $id, [
                'headers' => [
                    'Accept' => 'application/json',
                    'Authorization' => 'Bearer ' . $this->token
                ],
                'json' => [
                    'employeeNumber' => 9999,
                    'lastName' => 'Dayat',
                    'firstName' => 'Syarif',
                    'extension' => 'x9999',
                    'email' => 'syarifmuhammad369@gmail.com',
                    'officeCode' => '1',
                    'reportsTo' => 1002,
                    'jobTitle' => 'New President'
                ]
            ]);



            $result = json_decode($response->getBody()->getContents(), true);
            return $result;
        } catch (ClientException $e) {
            return json_decode($e->getResponse()->getBody()->getContents(), true);
        }
    }

    public function aksesApiDeleteEmployee($id)
    {
        try {
            $client = new \GuzzleHttp\Client();
            $response = $client->request('DELETE', $this->URL . '/' . $id, [
                'headers' => [
                    'Accept' => 'application/json',
                    'Authorization' => 'Bearer ' . $this->token
                ]
            ]);
            $result = json_decode($response->getBody()->getContents(), true);
            return $result;
        } catch (ClientException $e) {
            return json_decode($e->getResponse()->getBody()->getContents(), true);
        }
    }
}
