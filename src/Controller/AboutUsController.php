<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Entity\Worker;
use App\Form\ContactType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AboutUsController extends AbstractController
{
    /**
     * @Route("/qui-sommes-nous", name="about_us")
     * @return Response
     */
    public function index(): Response
    {
        $pioneers = $this->getDoctrine()
            ->getRepository(Worker::class)
            ->findBy(array('activity' => '4'));

        return $this->render('about_us/index.html.twig', [
            'pioneers' => $pioneers,
        ]);
    }
}
