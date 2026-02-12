<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

final class VehicleController extends AbstractController
{
    #[Route('/admin/vehicle', name: 'app_add_vehicle')]
    #[isGranted('ROLE_ADMIN')]
    public function index(): Response
    {
        return $this->render('add_vehicle/index.html.twig', [
            'controller_name' => 'AddVehicleController',
        ]);
    }
}
