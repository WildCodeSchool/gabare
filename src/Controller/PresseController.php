<?php

namespace App\Controller;

use App\Entity\Presse;
use App\Form\PresseType;
use App\Repository\PresseRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/presse")
 */
class PresseController extends AbstractController
{
    /**
     * @Route("/", name="presse_index", methods={"GET"})
     */
    public function index(PresseRepository $presseRepository): Response
    {
        return $this->render('presse/index.html.twig', [
            'presses' => $presseRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="presse_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $presse = new Presse();
        $form = $this->createForm(PresseType::class, $presse);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($presse);
            $entityManager->flush();

            return $this->redirectToRoute('presse_index');
        }

        return $this->render('presse/new.html.twig', [
            'presse' => $presse,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="presse_show", methods={"GET"})
     */
    public function show(Presse $presse): Response
    {
        return $this->render('presse/show.html.twig', [
            'presse' => $presse,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="presse_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Presse $presse): Response
    {
        $form = $this->createForm(PresseType::class, $presse);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('presse_index');
        }

        return $this->render('presse/edit.html.twig', [
            'presse' => $presse,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="presse_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Presse $presse): Response
    {
        if ($this->isCsrfTokenValid('delete'.$presse->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($presse);
            $entityManager->flush();
        }

        return $this->redirectToRoute('presse_index');
    }
}
