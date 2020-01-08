<?php

namespace App\Repository;

use App\Service\ConnectOdooService;

class ProductRepository
{
    /**
     * @var ConnectOdooService
     */
    private $connectOdooService;

    public function __construct(ConnectOdooService $connectOdooService)
    {
        $this->connectOdooService = $connectOdooService;
    }

    public function findAll()
    {
        $client = $this->connectOdooService->connectApi();

        $ids = $client->search('res.partner', [['customer', '=', true]], 0, 10);

        $fields = ['name'];

        $products = $client->read('res.partner', $ids, $fields);

        // hydrate des objets products

        return $products;
    }
}
