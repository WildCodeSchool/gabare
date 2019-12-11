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
 * @Route("admin/presse")
 */
class AdminPresseController extends AbstractController
{
    /**
     * @Route("/{id}", name="presse_show", methods={"GET"})
     */
    public function show(Presse $presse): Response
    {
        return $this->render('admin_presse/show.html.twig', [
            'presse' => $presse,
        ]);
    }

    /**
     * @Route("/{id}/modifier", name="presse_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Presse $presse): Response
    {
        $form = $this->createForm(PresseType::class, $presse);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('presse_show', ['id' => $presse->getId()]);
        }

        return $this->render('admin_presse/edit.html.twig', [
            'presse' => $presse,
            'form' => $form->createView(),
        ]);
    }
}
