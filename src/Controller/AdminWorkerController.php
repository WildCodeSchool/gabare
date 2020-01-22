<?php

namespace App\Controller;

use App\Entity\Worker;
use App\Form\WorkerType;
use App\Repository\WorkerRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/associe")
 */
class AdminWorkerController extends AbstractController
{
    /**
     * @Route("/", name="worker_index", methods={"GET"})
     * @IsGranted("ROLE_ADMIN_WHO", message = "Vous ne passerez pas!")
     */
    public function index(WorkerRepository $workerRepository): Response
    {
        return $this->render('admin_worker/index.html.twig', [
            'workers' => $workerRepository->findByActivitiesOrder(),
        ]);
    }

    /**
     * @Route("/new", name="worker_new", methods={"GET","POST"})
     * @IsGranted("ROLE_ADMIN_WHO", message = "Vous ne passerez pas!")
     */
    public function new(Request $request): Response
    {
        $worker = new Worker();
        $form = $this->createForm(WorkerType::class, $worker);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($worker);
            $entityManager->flush();

            $this->addFlash(
                'success',
                'Votre associé a été ajouté'
            );

            return $this->redirectToRoute('worker_index');
        }

        return $this->render('admin_worker/new.html.twig', [
            'worker' => $worker,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="worker_show", methods={"GET"})
     * @IsGranted("ROLE_ADMIN_WHO", message = "Vous ne passerez pas!")
     */
    public function show(Worker $worker): Response
    {
        return $this->render('admin_worker/show.html.twig', [
            'worker' => $worker,
        ]);
    }

    /**
     * @Route("/{id}/editer", name="worker_edit", methods={"GET","POST"})
     * @IsGranted("ROLE_ADMIN_WHO", message = "Vous ne passerez pas!")
     */
    public function edit(Request $request, Worker $worker): Response
    {
        $form = $this->createForm(WorkerType::class, $worker);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            $this->addFlash(
                'success',
                'Votre associé a été mis à jour'
            );

            return $this->redirectToRoute('worker_index');
        }

        return $this->render('admin_worker/edit.html.twig', [
            'worker' => $worker,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="worker_delete", methods={"DELETE"})
     * @IsGranted("ROLE_ADMIN_WHO", message = "Vous ne passerez pas!")
     */
    public function delete(Request $request, Worker $worker): Response
    {
        if ($this->isCsrfTokenValid('delete'.$worker->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($worker);
            $entityManager->flush();

            $this->addFlash(
                'danger',
                'Votre associé a été supprimé'
            );
        }

        return $this->redirectToRoute('worker_index');
    }
}
