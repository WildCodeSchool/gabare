<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use http\Env\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(): Response
    {
        $contact = new Contact();
        $contact->setProperty($contact);
        $form = $this->createForm(ContactType::class, $contact);


        return $this->render('home/index.html.twig', [
            'form' => $form->createView()
        ]);
    }

}
