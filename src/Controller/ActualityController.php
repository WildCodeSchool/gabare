<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class ActualityController extends AbstractController
{
    /**
     * @Route("/actualites", name="actuality_list")
     */
    public function show(): Response
    {
        return $this->render('actuality/index.html.twig', [
            'actualities' => $actualities,
        ]);
    }
}
