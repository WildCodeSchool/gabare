<?php

namespace App\Controller;

use App\Entity\Worker;
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
    public function index(WorkerRepository $workerRepository): Response
    {

        return $this->render('about_us/index.html.twig', [
            'pioneers' => $workerRepository->findAllPioneers(),
            'employees' => $workerRepository->findAllEmployees(),
        ]);
    }
}
