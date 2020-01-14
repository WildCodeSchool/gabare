<?php

namespace App\Controller;

use App\Entity\Value;
use App\Form\ValueType;
use App\Repository\ValueRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("admin/valeur")
 */
class AdminValueController extends AbstractController
{
    /**
     * @Route("/", name="value_index", methods={"GET"})
     */
    public function index(ValueRepository $valueRepository): Response
    {
        return $this->render('admin_value/index.html.twig', [
            'values' => $valueRepository->findAll(),
        ]);
    }

    /**
     * @Route("/ajouter", name="value_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $value = new Value();
        $form = $this->createForm(ValueType::class, $value);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($value);
            $entityManager->flush();

            $this->addFlash(
                'success',
                'Votre valeur a été ajouté'
            );

            return $this->redirectToRoute('value_index');
        }

        return $this->render('admin_value/new.html.twig', [
            'value' => $value,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="value_show", methods={"GET"})
     */
    public function show(Value $value): Response
    {
        return $this->render('admin_value/show.html.twig', [
            'value' => $value,
        ]);
    }

    /**
     * @Route("/{id}/editer", name="value_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Value $value): Response
    {
        $form = $this->createForm(ValueType::class, $value);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            $this->addFlash(
                'success',
                'Votre valeur a été mis à jour'
            );

            return $this->redirectToRoute('value_index');
        }

        return $this->render('admin_value/edit.html.twig', [
            'value' => $value,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="value_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Value $value): Response
    {
        if ($this->isCsrfTokenValid('delete'.$value->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($value);
            $entityManager->flush();

            $this->addFlash(
                'danger',
                'Votre valeur a été supprimé'
            );
        }

        return $this->redirectToRoute('value_index');
    }
}
