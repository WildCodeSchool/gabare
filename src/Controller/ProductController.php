<?php

namespace App\Controller;

use App\Form\SearchProductType;
use App\Repository\CategoryRepository;
use App\Repository\ProductRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
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
     * @Route("/nos-produits/{categoryId}", name="products_category")
     * @param ProductRepository $productRepository
     * @param CategoryRepository $categoryRepository
     * @param Request $request
     * @return Response
     */
    public function showByCategory(
        $categoryId,
        ProductRepository $productRepository,
        CategoryRepository $categoryRepository,
        Request $request
    ): Response {

        $categories = $categoryRepository->selectAllCategories();

        $parameters = $categories[$categoryId]->getChildIds();

        $parameters[] = intval($categoryId);

        $products = $productRepository->findByCategory($parameters);
        $form = $this->createForm(SearchProductType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $this->redirect('#productSection');
            $products = $productRepository->findByName($data['search']);
        }

        return $this->render('products/index.html.twig', [
            'products' => $products,
            'form' => $form->createView(),
            'categories' => $categories,
        ]);
    }
}
