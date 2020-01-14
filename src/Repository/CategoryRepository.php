<?php

namespace App\Repository;

use App\Entity\Product;
use App\Entity\Category;
use App\Service\ConnectOdooService;
use phpDocumentor\Reflection\DocBlock\Tags\Deprecated;

class CategoryRepository
{
    /**
     * @var ConnectOdooService
     */
    private $connectOdooService;

    const LIMIT = 50;

    const AVOID_CATEGORY = ['Hy', 'Hygi'];

    public function __construct(ConnectOdooService $connectOdooService)
    {
        $this->connectOdooService = $connectOdooService;
    }

    public function selectAllCategories()
    {
        $client = $this->connectOdooService->connectApi();

        $categoryIds = $client->search('product.category', [], 0, 150);

        $productFields = ['complete_name'];

        $categoriesApi = $client->read('product.category', $categoryIds, $productFields);

        $categories = [];
        $productsCategories = [];

        foreach ($categoriesApi as $category) {
            $categoryTotal = explode(' / ', $category['complete_name']);

            if (!in_array($categoryTotal[0], $categories) && !in_array($categoryTotal[0], self::AVOID_CATEGORY)) {
                $productCategory = new Category();
                $productCategory->setName($categoryTotal[0]);
                $categories[] = $categoryTotal[0];
                $productsCategories[] = $productCategory;
            }
        }

        return $productsCategories;
    }

    public function showByCategory($category)
    {
        $category = 'Viandes';
        $client = $this->connectOdooService->connectApi();

        $ids = $client->search('product.template', [['categ_id', '=', $category]], 0, 150);

        $fields = ['categ_id', 'name'];

        $products = $client->read('product.template', $ids, $fields);

        $articles = [];
        foreach ($products as $product) {
            $article = new Product();
            $article->setName($product['name']);
            $article->setCategory('categ_id');
            $articles[] = $article;
        }
        return $articles;
    }
}
