<?php


namespace App\Service;

use OdooClient\Client;

class ConnectOdooService
{
    public function connectApi()
    {
        $url = 'https://test-lagabare.druidoo.io/xmlrpc/2';
        $database = 'test-lagabare';
        $user = 'wilder';
        $password = 'cC+:[F$3cFb@.)3(';

        $client = new Client($url, $database, $user, $password);

        return $client;
    }
}
