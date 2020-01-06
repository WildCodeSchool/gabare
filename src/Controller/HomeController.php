<?php

namespace App\Controller;

use App\Entity\Alert;
use App\Entity\Contact;
use App\Form\ContactType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     * @return Response
     */
    public function index(): Response
    {
        $contact = new Contact();
        $form = $this->createForm(ContactType::class, $contact);

        $alert = $this->getDoctrine()
            ->getRepository(Alert::class)
            ->findOneBy([]);

        return $this->render('home/index.html.twig', [
            'form' => $form->createView(),
            'alert'=> $alert,
        ]);
    }
}
