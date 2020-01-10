<?php

namespace App\Controller;

use App\Entity\Article;
use App\Repository\ArticleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * @Route("/article", name="article_")
 */

class ArticleController extends AbstractController
{
    const ARTICLES = 9;

    /**
     * @Route("/{page}", name="list", requirements={"page" = "\d+"}, methods={"GET"}, defaults={"page" = 1})
     * @return Response
     */
    public function list(ArticleRepository $articleRepository, int $page): Response
    {
        $articles = $this->getDoctrine()
            ->getRepository(Article::class)
            ->findBy(
                [],
                ['date' => 'DESC'],
                self::ARTICLES
            );
        $articles = $articleRepository->findAllPagesAndSort($page);
        $nbArticles = count($articleRepository->findAllPagesAndSort());
        return $this->render('article/list.html.twig', [
            'articles' => $articles,
            'page' => $page,
            'nbPages' => ceil($nbArticles / self::ARTICLES),
        ]);
    }

    /**
     * @Route("/show/{slug}", name="show")
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
