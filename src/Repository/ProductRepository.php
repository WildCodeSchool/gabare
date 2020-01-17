<?php

namespace App\Repository;

use App\Entity\Product;
use App\Service\ConnectOdooService;
use App\Service\GetArticlesCategoryService;
use phpDocumentor\Reflection\DocBlock\Tags\Deprecated;

class ProductRepository
{
    /**
     * @var ConnectOdooService
     */
    private $connectOdooService;

    private $categoryService;

    public function __construct(ConnectOdooService $connectOdooService, GetArticlesCategoryService $categoryService)
    {
        $this->connectOdooService = $connectOdooService;
        $this->categoryService = $categoryService;
    }

    public function findAll($number = 20)
    {
        $client = $this->connectOdooService->connectApi();

        $ids = $client->search('product.template', [['sale_ok', '=', true]], 0, $number);

        $fields = ['name', 'base_price', 'categ_id'];

        $products = $client->read('product.template', $ids, $fields);

        $articles = $this->categoryService->setCategory($products);

        return $articles;
    }

    public function findByCategory(array $id)
    {
        $client = $this->connectOdooService->connectApi();

        $ids = $client->search('product.template', [['sale_ok', '=', true], ['categ_id', '=', $id]]);
        $fields = ['name', 'base_price', 'categ_id'];

        $products = $client->read('product.template', $ids, $fields);

        $articles = $articles = $this->categoryService->setCategory($products);

        return $articles;
    }

    public function findByName($name): array
    {
        $client = $this->connectOdooService->connectApi();
        $ids = $client->search('product.template', [['name', '=ilike', '%' . $name . '%']]);

        $fields = ['name', 'base_price', 'categ_id'];

        $products = $client->read('product.template', $ids, $fields);

        $articles = $articles = $this->categoryService->setCategory($products);

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
