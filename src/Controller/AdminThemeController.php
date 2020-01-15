<?php

namespace App\Controller;

use App\Entity\Theme;
use App\Form\ThemeType;
use App\Repository\ThemeRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/theme")
 */
class AdminThemeController extends AbstractController
{
    /**
     * @Route("/", name="theme_index", methods={"GET"})
     * @IsGranted("ROLE_ADMIN_GABARE_LIFE", message = "Vous ne passerez pas!")
     */
    public function index(ThemeRepository $themeRepository): Response
    {
        return $this->render('admin_theme/index.html.twig', [
            'themes' => $themeRepository->findAll(),
        ]);
    }

    /**
     * @Route("/ajouter", name="theme_new", methods={"GET","POST"})
     * @IsGranted("ROLE_ADMIN_GABARE_LIFE", message = "Vous ne passerez pas!")
     */
    public function new(Request $request): Response
    {
        $theme = new Theme();
        $form = $this->createForm(ThemeType::class, $theme);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($theme);
            $entityManager->flush();

            $this->addFlash(
                'success',
                'Votre thème a été ajouté'
            );

            return $this->redirectToRoute('theme_index');
        }

        return $this->render('admin_theme/new.html.twig', [
            'theme' => $theme,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="theme_show", methods={"GET"})
     * @IsGranted("ROLE_ADMIN_GABARE_LIFE", message = "Vous ne passerez pas!")
     */
    public function show(Theme $theme): Response
    {
        return $this->render('admin_theme/show.html.twig', [
            'theme' => $theme,
        ]);
    }

    /**
     * @Route("/{id}/éditer", name="theme_edit", methods={"GET","POST"})
     * @IsGranted("ROLE_ADMIN_GABARE_LIFE", message = "Vous ne passerez pas!")
     */
    public function edit(Request $request, Theme $theme): Response
    {
        $form = $this->createForm(ThemeType::class, $theme);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            $this->addFlash(
                'success',
                'Votre thème a été mis à jour'
            );

            return $this->redirectToRoute('theme_index');
        }

        return $this->render('admin_theme/edit.html.twig', [
            'theme' => $theme,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="theme_delete", methods={"DELETE"})
     * @IsGranted("ROLE_ADMIN_GABARE_LIFE", message = "Vous ne passerez pas!")
     */
    public function delete(Request $request, Theme $theme): Response
    {
        if ($this->isCsrfTokenValid('delete'.$theme->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($theme);
            $entityManager->flush();

            $this->addFlash(
                'danger',
                'Votre thème a été supprimé'
            );
        }

        return $this->redirectToRoute('theme_index');
    }
}
