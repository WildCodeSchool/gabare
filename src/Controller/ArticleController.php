<?php

namespace App\Controller;

use App\Entity\Article;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class ArticleController extends AbstractController
{
    /**
     * @Route("/article", name="article_list")
     * @return Response
     */
    public function list(): Response
    {
        $actualities = $this->getDoctrine()
            ->getRepository(Article::class)
            ->findBy(
                [],
                ['date' => 'DESC'],
                20
            );

        return $this->render('article/list.html.twig', [
            'actualities' => $actualities,
        ]);
    }

    /**
     * @Route("/show/{slug<^[a-z0-9-]+$>}", defaults={"slug" = null}, name="article_show")
     * @param Article $article
     * @return Response
     */
    public function show(Article $article): Response
    {
        return $this->render('article/show.html.twig', [
            'article' => $article,
        ]);
    }
}
