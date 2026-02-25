<?php

namespace App\Controller\Front;

use App\Repository\BrandRepository;
use App\Repository\VehicleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home', methods: ['GET'])]
    public function index(
        VehicleRepository $vehicleRepository,
        BrandRepository $brandRepository
    ): Response {

        $vehicleCount = $vehicleRepository->getDashboardStats();
        $brandCount   = $brandRepository->countBrands();

        return $this->render('home/index.html.twig', [
            'vehicleCount' => $vehicleCount,
            'brandCount'   => $brandCount,
        ]);
    }
}
