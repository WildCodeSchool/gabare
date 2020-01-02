<?php

namespace App\Controller;

use App\Entity\Timetable;
use App\Repository\TimetableRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class JoinUsController extends AbstractController
{
    /**
     * @Route("/nous-rejoindre", name="join_us")
     * @return Response
     */
    public function index(TimetableRepository $timetableRepository): Response
    {
        return $this->render('join_us/index.html.twig', [
            'timetables'=> $timetableRepository->findByDateExpiration(),
            ]);
    }
}
