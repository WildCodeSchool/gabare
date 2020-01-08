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
     * @Route("/show/{slug}",
     *     requirements={"slug"="[a-z0-9\-]+"},
     *     defaults={"slug"="Aucun article trouvé."},
     *     methods={"GET"},
     *     name="show")
     * @param string $slug
     * @param $id
     * @return Response
     */
    public function show(string $slug, int $id): Response
    {
        $slug = preg_replace(
            '/-/',
            ' ',
            ucwords(trim(strip_tags($slug)), "-")
        );

        $actualities = $this->getDoctrine()
            ->getRepository(Article::class)
            ->findBy(
                ['article.id' => mb_strtolower($slug)]
            );

        return $this->render('article/show.html.twig', [
            'actualities' => $actualities,
            'id' => $id,
        ]);
    }
}
