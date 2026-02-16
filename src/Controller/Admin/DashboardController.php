<?php

namespace App\Controller\Admin;

use App\Admin\Service\DashboardStatsService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
/**
 * Displays the admin dashboard with global system statistics.
 */
#[IsGranted('ROLE_ADMIN')]
final class DashboardController extends AbstractController
{
    #[Route('/admin', name: 'app_admin_dashboard')]
    public function dashboard(
        DashboardStatsService $statsService
    ): Response
    {
        $stats = $statsService->getStats();

        return $this->render('admin/dashboard.html.twig',[
        'vehicles'=> $stats['vehicles'],
            'brands'=> $stats['brands'],
            'clients'=> $stats['clients'],
            'vehiclesView' => $stats['vehiclesView'],
        ]);
    }
}
