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

    public function __construct(ConnectOdooService $connectOdooService)
    {
        $this->connectOdooService = $connectOdooService;
    }

    public function selectAllCategories()
    {
        $client = $this->connectOdooService->connectApi();

        $categoryIds = $client->search('product.category', [], 0, 150);

        $productFields = ['complete_name', 'parent_id', 'child_id'];


        $categoriesApi = $client->read('product.category', $categoryIds, $productFields);

        $productsCategories = [];

        foreach ($categoriesApi as $category) {
            if ($category['parent_id'] == null) {
                $productCategory = new Category();
                $productCategory->setName($category['complete_name']);
                $productCategory->setId($category['id']);
                $productCategory->setChildIds($category['child_id']);
                $productsCategories[$category['id']] = $productCategory;
            }
        }


        foreach ($categoriesApi as $category) {
            foreach ($productsCategories as $productsCategory) {
                if ($category['parent_id'] != null && $productsCategory->getChildIds() != null) {
                    if (in_array($category['parent_id'][0], $productsCategory->getChildIds())) {
                        $productsCategory->setChildIds($category['child_id']);
                    }
                }
            }
        }

        return $productsCategories;
    }
}
