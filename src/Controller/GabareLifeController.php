<?php

namespace App\Controller;


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
        $reports=$this->getDoctrine()
            ->getRepository(Report::class)
            ->findAll();
      
        $actualities =$this->getDoctrine()
            ->getRepository(Article::class)
            ->findAll();

        $themes = $this->getDoctrine()
            ->getRepository(Theme::class)
            ->findAll();

        return $this->render('gabare_life/index.html.twig', [
            'actualities' => $actualities,
            'themes' => $themes,
            'reports'=>$reports,
          ]);
          }
 }
