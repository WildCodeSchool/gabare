<?php

namespace App\Controller;

use App\Entity\Capital;
use App\Form\CapitalType;
use App\Repository\CapitalRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("admin/valeurs")
 */
class AdminCapitalController extends AbstractController
{
    /**
     * @Route("/", name="capital_index", methods={"GET"})
     * @IsGranted("ROLE_ADMIN_WHO", message = "Vous ne passerez pas!")
     */
    public function index(CapitalRepository $capitalRepository): Response
    {
        return $this->render('admin_capital/index.html.twig', [
            'capitals' => $capitalRepository->findAll(),
        ]);
    }

    /**
     * @Route("/ajouter", name="capital_new", methods={"GET","POST"})
     * @IsGranted("ROLE_ADMIN_WHO", message = "Vous ne passerez pas!")
     */
    public function new(Request $request): Response
    {
        $capital = new Capital();
        $form = $this->createForm(CapitalType::class, $capital);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($capital);
            $entityManager->flush();

            $this->addFlash(
                'success',
                'Votre valeur a été ajoutée'
            );

            return $this->redirectToRoute('capital_index');
        }

        return $this->render('admin_capital/new.html.twig', [
            'capital' => $capital,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="capital_show", methods={"GET"})
     * @IsGranted("ROLE_ADMIN_WHO", message = "Vous ne passerez pas!")
     */
    public function show(Capital $capital): Response
    {
        return $this->render('admin_capital/show.html.twig', [
            'capital' => $capital,
        ]);
    }

    /**
     * @Route("/{id}/editer", name="capital_edit", methods={"GET","POST"})
     * @IsGranted("ROLE_ADMIN_WHO", message = "Vous ne passerez pas!")
     */
    public function edit(Request $request, Capital $capital): Response
    {
        $form = $this->createForm(CapitalType::class, $capital);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            $this->addFlash(
                'success',
                'Votre valeur a été mise à jour'
            );

            return $this->redirectToRoute('capital_index');
        }

        return $this->render('admin_capital/edit.html.twig', [
            'capital' => $capital,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="capital_delete", methods={"DELETE"})
     * @IsGranted("ROLE_ADMIN_WHO", message = "Vous ne passerez pas!")
     */
    public function delete(Request $request, Capital $capital): Response
    {
        if ($this->isCsrfTokenValid('delete'.$capital->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($capital);
            $entityManager->flush();

            $this->addFlash(
                'danger',
                'Votre valeur a été supprimée'
            );
        }

        return $this->redirectToRoute('capital_index');
    }
}
