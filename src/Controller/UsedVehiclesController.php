<?php

namespace App\Controller;

use App\Repository\VehicleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class UsedVehiclesController extends AbstractController
{
    #[Route('/used/vehicles', name: 'app_used_vehicles')]
    public function index(VehicleRepository $vehicleRepository): Response
    {
        $usedVehicles = $vehicleRepository->getVehiclesUsed();
        return $this->render('home/usedVehicles.html.twig', [
            'controller_name' => 'UsedVehiclesController',
            'usedVehicles' => $usedVehicles,
        ]);
    }
}
