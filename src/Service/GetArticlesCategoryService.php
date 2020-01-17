<?php


namespace App\Service;

use App\Entity\Product;

class GetArticlesCategoryService
{
    public function setCategory($products)
    {
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
}
