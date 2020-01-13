<?php

namespace App\Controller;

use App\Form\SearchProductType;
use App\Repository\CategoryRepository;
use App\Repository\ProductRepository;
use App\Service\ConnectOdooService;
use Symfony\Component\HttpFoundation\Request;
use OdooClient\Client;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    /**
     * @Route("/nos-produits", name="products")
     * @param ProductRepository $productRepository
     * @param Request $request
     * @param CategoryRepository $categoryRepository
     * @return Response
     */

    public function index(
        ProductRepository $productRepository,
        Request $request,
        CategoryRepository $categoryRepository
    ): Response {

        $products = $productRepository->findAll();

        $form = $this->createForm(SearchProductType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $this->redirect('#productSection');
            $products = $productRepository->findByName($data['search']);
        }

        $categories = $categoryRepository->selectAllCategories();

        return $this->render('products/index.html.twig', [
            'products' => $products,
            'form' => $form->createView(),
            'categories' => $categories,
        ]);
    }

    /**
     * @Route("/nos-produits/{categoryName}", name="products_category")
     * @param ProductRepository $productRepository
     * @param Request $request
     * @return Response
     */
    public function showByCategory(
        $categoryName,
        ProductRepository $productRepository,
        Request $request
    ): Response {

        $products = $productRepository->findAll();

        $productsByCategory = [];
        foreach ($products as $product) {
            if (substr($product->getCategory()[1], 0, strlen($categoryName)) == $categoryName) {
                $productsByCategory[] = $product;
            }
        }

        dump($productsByCategory);

        return $this->render('products/show_products.html.twig', [
            'products' => $productsByCategory,
        ]);
    }
}
