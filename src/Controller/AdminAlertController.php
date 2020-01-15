<?php

namespace App\Controller;

use App\Entity\Alert;
use App\Form\AlertType;
use App\Repository\AlertRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("admin/alerte")
 */
class AdminAlertController extends AbstractController
{
    /**
     * @Route("/editer", name="alert_edit", methods={"GET","POST"})
     * @IsGranted("ROLE_ADMIN_HOME", message = "Vous ne passerez pas!")
     * @return Response
     */
    public function edit(Request $request): Response
    {
        $alert = $this->getDoctrine()
            ->getRepository(Alert::class)
            ->findOneBy([]);
        if (!$alert instanceof Alert) {
            $alert = new Alert();
        }

        $form = $this->createForm(AlertType::class, $alert);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash('success', "Votre alerte a bien été modifiée");

            return $this->redirectToRoute('alert_edit');
        }

        return $this->render('admin_alert/edit.html.twig', [
            'alert' => $alert,
            'form' => $form->createView(),
        ]);
    }
}
