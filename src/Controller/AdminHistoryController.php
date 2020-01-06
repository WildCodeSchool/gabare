<?php

namespace App\Controller;

use App\Entity\History;
use App\Form\HistoryType;
use App\Repository\HistoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("admin/history")
 */
class AdminHistoryController extends AbstractController
{
    /**
     * @Route("/{id}", name="history_show", methods={"GET"})
     */
    public function show(History $history): Response
    {
        return $this->render('admin_history/show.html.twig', [
            'history' => $history,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="history_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, History $history): Response
    {
        $form = $this->createForm(HistoryType::class, $history);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('history_index', ['id' => $history->getId()]);
        }

        return $this->render('admin_history/edit.html.twig', [
            'history' => $history,
            'form' => $form->createView(),
        ]);
    }
}
