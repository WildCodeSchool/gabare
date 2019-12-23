<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class JoinUsController extends AbstractController
{
    /**
     * @Route("/nous-rejoindre", name="join_us")
     * @return Response
     */
    public function index(): Response
    {

        return $this->render('join_us/index.html.twig');
    }
}
