<?php

namespace App\Repository;

use App\Service\ConnectOdooService;

class CustomerRepository
{
    /**
     * @var ConnectOdooService
     */
    private $connectOdooService;

    public function __construct(ConnectOdooService $connectOdooService)
    {
        $this->connectOdooService = $connectOdooService;
    }

    public function countAll()
    {
        $client = $this->connectOdooService->connectApi();

        $criteria = [
            ['customer', '=', true],
        ];

        $customers = $client->search_count('res.partner', $criteria);

        return $customers;
    }
}
