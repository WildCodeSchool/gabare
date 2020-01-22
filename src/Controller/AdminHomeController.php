<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Dompdf\Dompdf;
use Dompdf\Options;

class AdminHomeController extends AbstractController
{
    /**
     * @Route("/admin/accueil", name="admin_home")
     * @IsGranted("ROLE_USER", message = "Vous ne passerez pas!")
     */
    public function index(UserRepository $userRepository)
    {
        return $this->render('admin_home/index.html.twig', [
            'users'=>$userRepository->findAll(),
        ]);
    }

    /**
     * @Route("/admin/instructions", name="pdf_view")
     * @IsGranted("ROLE_USER", message = "Vous ne passerez pas!")
     */
    public function viewPdf()
    {
        $pdfOptions = new Options();
        $pdfOptions->set('defaultFont', 'Arial');

        // Instantiate Dompdf with our options
        $dompdf = new Dompdf($pdfOptions);

        // Retrieve the HTML generated in our twig file
        $html = $this->renderView('admin_home/pdf_view.html.twig');

        // Load HTML to Dompdf
        $dompdf->loadHtml($html);

        // (Optional) Setup the paper size and orientation 'portrait' or 'portrait'
        $dompdf->setPaper('A4', 'portrait');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser (inline view)
        $dompdf->stream("mypdf.pdf", [
            "Attachment" => false
        ]);
    }
}
