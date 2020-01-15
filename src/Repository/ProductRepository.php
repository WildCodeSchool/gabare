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

    public function __construct(ConnectOdooService $connectOdooService)
    {
        $this->connectOdooService = $connectOdooService;
    }

    public function findAll($number = 20)
    {
        $client = $this->connectOdooService->connectApi();

        $ids = $client->search('product.template', [['sale_ok', '=', true]], 0, $number);

        $fields = ['name', 'base_price', 'categ_id'];

        $products = $client->read('product.template', $ids, $fields);

        $articles = [];
        foreach ($products as $product) {
            $article = new Product();
            $article->setName($product['name']);
            $article->setPrice($product['base_price']);
            $category = explode(' / ', $product['categ_id'][1]);
            $article->setCategory([$product['categ_id'][0],$category[0]]);
            $articles[] = $article;
        }

        return $articles;
    }

    public function findByCategory(int $id)
    {
        $client = $this->connectOdooService->connectApi();

        $ids = $client->search('product.template', [['sale_ok', '=', true], ['categ_id', '=', $id]]);
        $fields = ['name', 'base_price', 'categ_id'];

        $products = $client->read('product.template', $ids, $fields);

        $articles = [];
        foreach ($products as $product) {
            $article = new Product();
            $article->setName($product['name']);
            $article->setPrice($product['base_price']);
            $category = explode(' / ', $product['categ_id'][1]);
            if (isset($category[1])) {
                $category = $category[1];
            } else {
                $category = $category[0];
            }
            $article->setCategory([$product['categ_id'][0], $category]);
            $articles[] = $article;
        }
        return $articles;
    }

    public function findByName($name) :array
    {
        $client = $this->connectOdooService->connectApi();
        $ids = $client->search('product.template', [['name','=ilike', '%'.$name.'%']]);

        $fields = ['name', 'base_price', 'categ_id'];

        $products = $client->read('product.template', $ids, $fields);

        $articles = [];
        foreach ($products as $product) {
            $article = new Product();
            $article->setName($product['name']);
            $article->setPrice($product['base_price']);
            $category = explode(' / ', $product['categ_id'][1]);
            $article->setCategory([$product['categ_id'][0],$category[0]]);
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
