<?php

namespace App\Controller;

use App\Entity\Timetable;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class JoinUsController extends AbstractController
{
    /**
     * @Route("/nous-rejoindre", name="join_us")
     * @return Response
     */
    public function index(): Response
    {
        $timetables = $this->getDoctrine()
            ->getRepository(Timetable::class)
            ->findAll();
        return $this->render('join_us/index.html.twig', [
            'timetables'=>$timetables
            ]);
    }
}
