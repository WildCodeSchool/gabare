<?php

namespace App\Controller;

use App\Service\ConnectOdooService;
use OdooClient\Client;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ApiController extends AbstractController
{
    /**
     * @Route("/nos-produits", name="products")
     * @return Response
     */

    public function index(ConnectOdooService $connectOdooService): Response
    {

        return $this->render('products/index.html.twig', [

        ]);
    }
}
