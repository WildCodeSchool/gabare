<?php

namespace App\Controller;

use App\Entity\History;
use App\Entity\Worker;
use App\Entity\Value;
use App\Repository\CustomerRepository;
use App\Repository\ProductRepository;
use App\Repository\WorkerRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AboutUsController extends AbstractController
{
    /**
     * @Route("/qui-sommes-nous", name="about_us")
     * @return Response
     */
    public function index(
        WorkerRepository $workerRepository,
        ProductRepository $productRepository,
        CustomerRepository $customerRepository
    ): Response {

        $history = $this->getDoctrine()
            ->getRepository(History::class)
            ->findAll();

        $values = $this->getDoctrine()
            ->getRepository(Value::class)
            ->findAll();

        $products = $productRepository->countAll();

        $customers = $customerRepository->countAll();

        return $this->render('about_us/index.html.twig', [
            'pioneers' => $workerRepository->findAllPioneers(),
            'employees' => $workerRepository->findAllEmployees(),
            'CAMembers' => $workerRepository->findAllCAMembers(),
            'CAFriends' => $workerRepository->findAllCAFriends(),
            'history' => $history,
            'product' => $products,
            'customers' => $customers,
            'values' => $values,
        ]);
    }
}
