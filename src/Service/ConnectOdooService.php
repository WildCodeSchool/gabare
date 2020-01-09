<?php


namespace App\Service;

use OdooClient\Client;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

class ConnectOdooService
{
    private $parameterBag;

    public function __construct(ParameterBagInterface $parameterBag)
    {
        $this->parameterBag = $parameterBag;
    }

    public function connectApi()
    {
        $url = $this->parameterBag->get('api_url');
        $database = $this->parameterBag->get('api_database');
        $user = $this->parameterBag->get('api_user');
        $password = $this->parameterBag->get('api_password');

        $client = new Client($url, $database, $user, $password);

        return $client;
    }
}
