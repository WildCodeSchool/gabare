<?php

namespace App\Controller;

use App\Entity\Carousel;
use App\Form\CarouselType;
use App\Repository\CarouselRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/carousel")
 */
class AdminCarouselController extends AbstractController
{
    /**
     * @Route("/", name="carousel_index", methods={"GET"})
     * @IsGranted("ROLE_ADMIN_HOME", message = "Vous ne passerez pas!")
     */
    public function index(CarouselRepository $carouselRepository): Response
    {
        return $this->render('admin_carousel/index.html.twig', [
            'carousels' => $carouselRepository->findAll(),
        ]);
    }

    /**
     * @Route("/ajouter", name="carousel_new", methods={"GET","POST"})
     * @IsGranted("ROLE_ADMIN_HOME", message = "Vous ne passerez pas!")
     */
    public function new(Request $request): Response
    {
        $carousel = new Carousel();
        $form = $this->createForm(CarouselType::class, $carousel);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($carousel);
            $entityManager->flush();

            $this->addFlash(
                'success',
                'Votre contenu a été ajouté au carrousel'
            );

            return $this->redirectToRoute('carousel_index');
        }

        return $this->render('admin_carousel/new.html.twig', [
            'carousel' => $carousel,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="carousel_show", methods={"GET"})
     * @IsGranted("ROLE_ADMIN_HOME", message = "Vous ne passerez pas!")
     */
    public function show(Carousel $carousel): Response
    {
        return $this->render('admin_carousel/show.html.twig', [
            'carousel' => $carousel,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="carousel_edit", methods={"GET","POST"})
     * @IsGranted("ROLE_ADMIN_HOME", message = "Vous ne passerez pas!")
     */
    public function edit(Request $request, Carousel $carousel): Response
    {
        $form = $this->createForm(CarouselType::class, $carousel);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            $this->addFlash(
                'success',
                'Votre contenu a été mis à jour dans le carrousel'
            );

            return $this->redirectToRoute('carousel_show');
        }

        return $this->render('admin_carousel/edit.html.twig', [
            'carousel' => $carousel,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="carousel_delete", methods={"DELETE"})
     * @IsGranted("ROLE_ADMIN_HOME", message = "Vous ne passerez pas!")
     */
    public function delete(Request $request, Carousel $carousel): Response
    {
        if ($this->isCsrfTokenValid('delete'.$carousel->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($carousel);
            $entityManager->flush();
        }

        return $this->redirectToRoute('carousel_index');
    }
}
