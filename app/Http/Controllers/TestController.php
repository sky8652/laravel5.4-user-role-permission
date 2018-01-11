<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function index()
    {
        $client = new Client();
        $response = $client->request('POST', 'http://172.16.2.204:5000/', [
            'multipart' => [
                [
                    'name'     => 'name',
                    'contents' => fopen('piaoju-1.jpg', 'r')
                ],
            ]
        ]);

        echo $response->getBody();

    }
}
