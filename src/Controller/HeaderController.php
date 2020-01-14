<?php

namespace App\Controller;

use App\Repository\CustomerRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HeaderController extends AbstractController
{
    public function lastestCustomers(CustomerRepository $customerRepository)
    {
        $customer = $customerRepository->countAll();

        return $this->render('_customers.html.twig', [
            'customers' => $customer,
        ]);
    }
}
