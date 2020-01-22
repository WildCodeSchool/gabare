<?php

namespace App\Controller;

use App\Entity\Article;
use App\Form\ArticleType;
use App\Repository\ArticleRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\FormTypeInterface;

/**
 * @Route("/admin/article")
 */
class AdminArticleController extends AbstractController
{
    /**
     * @Route("/", name="article_index", methods={"GET"})
     * @IsGranted("ROLE_ADMIN_GABARE_LIFE", message = "Vous ne passerez pas!")
     */
    public function index(ArticleRepository $articleRepository): Response
    {
        return $this->render('admin_article/index.html.twig', [
            'articles' => $articleRepository->findAll(),
        ]);
    }

    /**
     * @Route("/ajouter", name="article_new", methods={"GET","POST"})
     * @IsGranted("ROLE_ADMIN_GABARE_LIFE", message = "Vous ne passerez pas!")
     */
    public function new(Request $request): Response
    {
        $article = new Article();
        $form = $this->createForm(ArticleType::class, $article);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($article);
            $entityManager->flush();

            $this->addFlash(
                'success',
                'Votre article a été ajouté'
            );

            return $this->redirectToRoute('article_index');
        }

        return $this->render('admin_article/new.html.twig', [
            'article' => $article,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="article_show", methods={"GET"})
     * @IsGranted("ROLE_ADMIN_GABARE_LIFE", message = "Vous ne passerez pas!")
     */
    public function show(Article $article): Response
    {
        return $this->render('admin_article/show.html.twig', [
            'article' => $article,
        ]);
    }

    /**
     * @Route("/{id}/editer", name="article_edit", methods={"GET","POST"})
     * @IsGranted("ROLE_ADMIN_GABARE_LIFE", message = "Vous ne passerez pas!")
     */
    public function edit(Request $request, Article $article): Response
    {
        $form = $this->createForm(ArticleType::class, $article);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            $this->addFlash(
                'success',
                'Votre article a été mis à jour'
            );

            return $this->redirectToRoute('article_index');
        }

        return $this->render('admin_article/edit.html.twig', [
            'article' => $article,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="article_delete", methods={"DELETE"})
     * @IsGranted("ROLE_ADMIN_GABARE_LIFE", message = "Vous ne passerez pas!")
     */
    public function delete(Request $request, Article $article): Response
    {
        if ($this->isCsrfTokenValid('delete'.$article->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($article);
            $entityManager->flush();

            $this->addFlash(
                'danger',
                'Votre article a été supprimé'
            );
        }

        return $this->redirectToRoute('article_index');
    }
}
