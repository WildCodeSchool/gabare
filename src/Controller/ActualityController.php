<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ActualityController extends AbstractController
{
    /**
     * @Route("/actuality", name="actuality_list")
     */
    public function index()
    {
        return $this->render('actuality/index.html.twig', [
            'controller_name' => 'ActualityController',
        ]);
    }
}
