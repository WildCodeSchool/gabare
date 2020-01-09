<?php

namespace App\Controller;

use App\Repository\ProductRepository;
use App\Service\ConnectOdooService;
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

    public function index(ProductRepository $productRepository): Response
    {
        $products = $productRepository->findAll();

        return $this->render('products/index.html.twig', [
            'products' => $products,

        ]);
    }
}
