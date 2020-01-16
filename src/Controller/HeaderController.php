<?php

namespace App\Controller;

use App\Entity\Alert;
use App\Repository\CustomerRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HeaderController extends AbstractController
{
    public function lastestCustomers(CustomerRepository $customerRepository)
    {
        $customer = $customerRepository->countAll();

        $alert = $this->getDoctrine()
            ->getRepository(Alert::class)
            ->findOneBy([]);

        return $this->render('_customers.html.twig', [
            'customers' => $customer,
            'alert' => $alert,
        ]);
    }
}
