<?php

namespace App\Controller\Admin;

use App\Entity\User;
use App\Service\Pdf\PdfGenerator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class AdminPdfController extends AbstractController
{
    #[Route('/admin/client/{id}/pdf', name: 'admin_client_pdf', requirements: ['id'=>'\d+'], methods: ['GET'])]
    public function clientPdf(
        User $client,
        PdfGenerator $pdf
    ): Response {

        return $pdf->generate(
            'admin/user/pdf.html.twig',
            [
                'client' => $client
            ],
        );
    }
}
