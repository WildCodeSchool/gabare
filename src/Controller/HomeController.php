<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use App\Repository\CarouselRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     * @return Response
     */
    public function index(CarouselRepository $carouselRepository): Response
    {
        $contact = new Contact();
        $form = $this->createForm(ContactType::class, $contact);

        return $this->render('home/index.html.twig', [
            'form' => $form->createView(),
            'carousels' => $carouselRepository->findAll(),
        ]);
    }
}
