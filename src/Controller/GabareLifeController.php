<?php

namespace App\Controller;

use App\Entity\Report;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class GabareLifeController extends AbstractController
{
    /**
     * @Route("/vie-cooperative", name="gabare_life")
     */
    public function index()
    {
        $reports=$this->getDoctrine()
            ->getRepository(Report::class)
            ->findAll();

        return $this->render('gabare_life/index.html.twig', [
            'reports'=>$reports
        ]);
    }
}
