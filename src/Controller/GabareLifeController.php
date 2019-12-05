<?php

namespace App\Controller;

use App\Entity\Presse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class GabareLifeController extends AbstractController
{
    /**
     * @Route("/vie-cooperative", name="gabare_life")
     */
    public function index()
    {
        $presse = $this->getDoctrine()
            ->getRepository(Presse::class)
            ->findAll();

        return $this->render('gabare_life/index.html.twig', [
            'presse' => $presse,
        ]);
    }
}
