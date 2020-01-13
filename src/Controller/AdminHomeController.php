<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AdminHomeController extends AbstractController
{
    /**
     * @Route("/admin/accueil", name="admin_home")
     */
    public function index(UserRepository $userRepository)
    {
        return $this->render('admin_home/index.html.twig', [
            'users'=>$userRepository->findAll(),
        ]);
    }
}
