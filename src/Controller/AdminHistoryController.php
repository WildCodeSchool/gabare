<?php

namespace App\Controller;

use App\Entity\History;
use App\Form\HistoryType;
use App\Repository\HistoryRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("admin/histoire")
 */
class AdminHistoryController extends AbstractController
{
    /**
     * @Route("/", name="history_index", methods={"GET"})
     * @IsGranted("ROLE_ADMIN_WHO", message = "Vous ne passerez pas!")
     */
    public function index(HistoryRepository $historyRepository): Response
    {
        return $this->render('admin_history/index.html.twig', [
            'histories' => $historyRepository->findAll(),
        ]);
    }

    /**
     * @Route("/{id}", name="history_show", methods={"GET"})
     * @IsGranted("ROLE_ADMIN_WHO", message = "Vous ne passerez pas!")
     */
    public function show(History $history): Response
    {
        return $this->render('admin_history/show.html.twig', [
            'history' => $history,
        ]);
    }

    /**
     * @Route("/{id}/editer", name="history_edit", methods={"GET","POST"})
     * @IsGranted("ROLE_ADMIN_WHO", message = "Vous ne passerez pas!")
     */
    public function edit(Request $request, History $history): Response
    {
        $history = $this->getDoctrine()
            ->getRepository(History::class)
            ->findOneBy([]);
        if (!$history instanceof History) {
            $history = new History();
        }

        $form = $this->createForm(HistoryType::class, $history);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash('success', 'Les modifications ont été réalisées avec succès');

            return $this->redirectToRoute('history_show', ['id' => $history->getId()]);
        }

        return $this->render('admin_history/edit.html.twig', [
            'history' => $history,
            'form' => $form->createView(),
        ]);
    }
}
