<?php

namespace App\Controller;

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

    public function index(ConnectOdooService $connectOdooService): Response
    {
        $client = $connectOdooService->connectApi();

        $ids = $client->search('res.partner', [['customer', '=', true]], 0, 10);

        $fields = ['name', 'email', 'age'];

        $customers = $client->read('res.partner', $ids, $fields);
        dd($customers);
        return $this->render('products/index.html.twig', [
        'customers' => $customers
        ]);
    }
}
