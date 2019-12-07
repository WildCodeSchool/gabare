<?php

namespace App\Controller;

use App\Entity\Presse;
use App\Entity\Article;
use App\Entity\Theme;
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
        $presse = $this->getDoctrine()
            ->getRepository(Presse::class)
            ->findAll();

        $reports = $this->getDoctrine()
            ->getRepository(Report::class)
            ->findAll();

        $actualities = $this->getDoctrine()
            ->getRepository(Article::class)
            ->findAll();

        $themes = $this->getDoctrine()
            ->getRepository(Theme::class)
            ->findAll();

        return $this->render('gabare_life/index.html.twig', [
            'reports'=>$reports,
            'admin_presse' => $presse,
            'actualities' => $actualities,
            'themes' => $themes,
        ]);
    }
}
