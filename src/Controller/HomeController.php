<?php

namespace App\Controller;

use App\Entity\Alert;
use App\Entity\Contact;
use App\Form\ContactType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Mime\Email;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     * @param Request $request
     * @param MailerInterface $mailer
     * @return Response
     * @throws TransportExceptionInterface
     */

    public function index(Request $request, MailerInterface $mailer): Response
    {
        $contact = new Contact();
        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $dataContact = $form->getData();
            $email = (new Email())
                ->from($this->getParameter('mailer_from'))
                ->to($this->getParameter('mailer_from'))
                ->subject('Vous avez reçu un nouveau message.')
                ->html($this->renderView('emails/_contact.html.twig', [
                    'dataContact' => $dataContact
                ]));
            $mailer->send($email);
            $this->addFlash('success', 'Votre email a été envoyé avec succès');
            return $this->redirect('#contact');
        }

        $alert = $this->getDoctrine()
            ->getRepository(Alert::class)
            ->findOneBy([]);

        return $this->render('home/index.html.twig', [
            'form' => $form->createView(),
            'alert'=> $alert,
        ]);
    }
}
