<?php

namespace App\Controller;

use App\Entity\Article;
use App\Repository\CustomerRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

/**
 * @Route("/article", name="article_")
 */

class ArticleController extends AbstractController
{

    const ARTICLES = 9;

    /**
     * @Route("/", name="list")
     * @return Response
     */
    public function list(CustomerRepository $customerRepository): Response
    {
        $articles = 0;
        $articles = $this->getDoctrine()
            ->getRepository(Article::class)
            ->findBy(
                [],
                ['date' => 'DESC'],
                self::ARTICLES
            );
        return $this->render('article/list.html.twig', [
            'articles' => $articles,
            'customers' => $customerRepository->countAll(),
        ]);
    }

    /**
     * @Route("/show/{slug}", name="show")
     * @param Article $article
     * @return Response
     */
    public function show(Article $article, CustomerRepository $customerRepository): Response
    {
        return $this->render('article/show.html.twig', [
            'article' => $article,
            'customers' => $customerRepository->countAll(),
        ]);
    }
}
