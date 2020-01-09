<?php

namespace App\Controller;

use App\Entity\Partner;
use App\Entity\Worker;
use App\Repository\WorkerRepository;
use App\Repository\PartnerRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AboutUsController extends AbstractController
{
    /**
     * @Route("/qui-sommes-nous", name="about_us")
     * @return Response
     */
    public function index(WorkerRepository $workerRepository, PartnerRepository $partnerRepository): Response
    {
        $partners = $partnerRepository->findAll();

        return $this->render('about_us/index.html.twig', [
            'pioneers' => $workerRepository->findAllPioneers(),
            'employees' => $workerRepository->findAllEmployees(),
            'CAMembers' => $workerRepository->findAllCAMembers(),
            'CAFriends' => $workerRepository->findAllCAFriends(),
            'partners' => $partners,
        ]);
    }
}
