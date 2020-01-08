<?php

namespace App\Controller;

use App\Entity\Article;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

/**
 * @Route("/article", name="article_")
 */

class ArticleController extends AbstractController
{
    /**
     * @Route("/", name="list")
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
     * @Route("/show/{id}", name="show", methods={"GET"})
     * @param int $id
     * @return Response
     */
    public function show(int $id): Response
    {
        $actualities = $this->getDoctrine()
            ->getRepository(Article::class)
            ->find($id);

        return $this->render('article/show.html.twig', [
            'actualities' => $actualities,
            'id' => $id,
        ]);
    }
}
