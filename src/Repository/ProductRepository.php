<?php

namespace App\Repository;

use App\Entity\Product;
use App\Service\ConnectOdooService;
use phpDocumentor\Reflection\DocBlock\Tags\Deprecated;

class ProductRepository
{
    /**
     * @var ConnectOdooService
     */
    private $connectOdooService;

    const LIMIT = 50;

    public function __construct(ConnectOdooService $connectOdooService)
    {
        $this->connectOdooService = $connectOdooService;
    }

    public function findAll()
    {
        $client = $this->connectOdooService->connectApi();

        $ids = $client->search('product.template', [['sale_ok', '=', true]], 0, self::LIMIT);

        $fields = ['name', 'base_price', 'categ_id'];

        $products = $client->read('product.template', $ids, $fields);

        $articles = [];
        foreach ($products as $product) {
            $article = new Product();
            $article->setName($product['name']);
            $article->setPrice($product['base_price']);
            $article->setCategory($product['categ_id']);
            $articles[] = $article;
        }
        return $articles;
    }

    public function findByName($name): array
    {
        $client = $this->connectOdooService->connectApi();

        $ids = $client->search('product.template', [['name', '=ilike', '%' . $name . '%']], 0, self::LIMIT);

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

    public function countAll()
    {
        $client = $this->connectOdooService->connectApi();

        $criteria = [
            ['sale_ok', '=', true],
        ];

        $products = $client->search_count('product.template', $criteria);

        return $products;
    }
}
