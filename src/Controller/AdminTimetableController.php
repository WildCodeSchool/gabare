<?php

namespace App\Controller;

use App\Entity\Timetable;
use App\Form\TimetableType;
use App\Repository\TimetableRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/agenda")
 */
class AdminTimetableController extends AbstractController
{
    /**
     * @Route("/", name="timetable_index", methods={"GET"})
     */
    public function index(TimetableRepository $timetableRepository): Response
    {
        return $this->render('admin_timetable/index.html.twig', [
            'timetables' => $timetableRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="timetable_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $timetable = new Timetable();
        $form = $this->createForm(TimetableType::class, $timetable);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($timetable);
            $entityManager->flush();

            $this->addFlash(
                'danger',
                'Votre article a été supprimé'
            );

            return $this->redirectToRoute('timetable_index');
        }

        return $this->render('admin_timetable/new.html.twig', [
            'admin_timetable' => $timetable,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="timetable_show", methods={"GET"})
     */
    public function show(Timetable $timetable): Response
    {
        return $this->render('admin_timetable/show.html.twig', [
            'admin_timetable' => $timetable,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="timetable_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Timetable $timetable): Response
    {
        $form = $this->createForm(TimetableType::class, $timetable);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('timetable_index');
        }

        return $this->render('admin_timetable/edit.html.twig', [
            'admin_timetable' => $timetable,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="timetable_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Timetable $timetable): Response
    {
        if ($this->isCsrfTokenValid('delete'.$timetable->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($timetable);
            $entityManager->flush();
        }

        return $this->redirectToRoute('timetable_index');
    }
}
