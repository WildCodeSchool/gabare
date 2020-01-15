<?php

namespace App\Controller;

use App\Entity\Animation;
use App\Form\AnimationType;
use App\Repository\AnimationRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/animation")
 */
class AdminAnimationController extends AbstractController
{
    /**
     * @Route("/", name="animation_index", methods={"GET"})
     * @IsGranted("ROLE_ADMIN_GABARE_LIFE", message = "Vous ne passerez pas!")
     */
    public function index(AnimationRepository $animationRepository): Response
    {
        return $this->render('admin_animation/index.html.twig', [
            'animations' => $animationRepository->findAll(),
        ]);
    }

    /**
     * @Route("/ajouter", name="animation_new", methods={"GET","POST"})
     * @IsGranted("ROLE_ADMIN_GABARE_LIFE", message = "Vous ne passerez pas!")
     */
    public function new(Request $request): Response
    {
        $animation = new Animation();
        $form = $this->createForm(AnimationType::class, $animation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($animation);
            $entityManager->flush();

            $this->addFlash(
                'success',
                'Votre animation a été ajoutée'
            );

            return $this->redirectToRoute('animation_index');
        }

        return $this->render('admin_animation/new.html.twig', [
            'animation' => $animation,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="animation_show", methods={"GET"})
     * @IsGranted("ROLE_ADMIN_GABARE_LIFE", message = "Vous ne passerez pas!")
     */
    public function show(Animation $animation): Response
    {
        return $this->render('admin_animation/show.html.twig', [
            'animation' => $animation,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="animation_edit", methods={"GET","POST"})
     * @IsGranted("ROLE_ADMIN_GABARE_LIFE", message = "Vous ne passerez pas!")
     */
    public function edit(Request $request, Animation $animation): Response
    {
        $form = $this->createForm(AnimationType::class, $animation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            $this->addFlash(
                'success',
                'Votre animation a été mise à jour'
            );

            return $this->redirectToRoute('animation_index');
        }

        return $this->render('admin_animation/edit.html.twig', [
            'animation' => $animation,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="animation_delete", methods={"DELETE"})
     * @IsGranted("ROLE_ADMIN_GABARE_LIFE", message = "Vous ne passerez pas!")
     */
    public function delete(Request $request, Animation $animation): Response
    {
        if ($this->isCsrfTokenValid('delete'.$animation->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($animation);
            $entityManager->flush();

            $this->addFlash(
                'danger',
                'Votre animation a été supprimée'
            );
        }

        return $this->redirectToRoute('animation_index');
    }
}
