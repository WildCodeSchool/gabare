<?php

namespace App\Controller;

use App\Form\SearchProductType;
use App\Repository\CustomerRepository;
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
     * @return Response
     */
    public function index(
        ProductRepository $productRepository,
        Request $request
    ): Response {
        $products = $productRepository->findAll();

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
        ]);
    }
}
