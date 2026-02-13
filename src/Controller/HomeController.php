<?php

namespace App\Controller;

use App\Repository\VehicleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(VehicleRepository $vehicleRepository): Response
    {
        //Todo afficher le nombre de véhicules disponible sur le site
        $allVehicle = $vehicleRepository->countVehicles();
        //Todo afficher le nombre de marques
        //Todo Afficher les cards de véhicules récemment ajoutés

        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'allVehicle' => $allVehicle
        ]);
    }
}
