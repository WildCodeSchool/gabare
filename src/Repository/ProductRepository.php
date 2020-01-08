<?php

namespace App\Repository;

use App\Entity\Product;
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

        $ids = $client->search('product.template', [['sale_ok', '=', true]], 0, 10);

        $fields = ['name', 'base_price'];

        $products = $client->read('product.template', $ids, $fields);

        $articles = [];
        foreach ($products as $product) {
            $article = new Product();
            $article->setName($product['name']);
            $article->setPrice($product['base_price']);
            $articles[] = $article;
        }
        return $articles;
    }
}
