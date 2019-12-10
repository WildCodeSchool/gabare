<?php

namespace App\Controller;

use App\Entity\Animation;
use App\Form\AnimationType;
use App\Repository\AnimationRepository;
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
     */
    public function index(AnimationRepository $animationRepository): Response
    {
        return $this->render('admin_animation/index.html.twig', [
            'animations' => $animationRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="animation_new", methods={"GET","POST"})
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

            return $this->redirectToRoute('animation_index');
        }

        return $this->render('animation/new.html.twig', [
            'animation' => $animation,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="animation_show", methods={"GET"})
     */
    public function show(Animation $animation): Response
    {
        return $this->render('animation/show.html.twig', [
            'animation' => $animation,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="animation_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Animation $animation): Response
    {
        $form = $this->createForm(AnimationType::class, $animation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('animation_index');
        }

        return $this->render('animation/edit.html.twig', [
            'animation' => $animation,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="animation_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Animation $animation): Response
    {
        if ($this->isCsrfTokenValid('delete'.$animation->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($animation);
            $entityManager->flush();
        }

        return $this->redirectToRoute('animation_index');
    }
}
