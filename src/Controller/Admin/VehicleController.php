<?php

namespace App\Controller\Admin;

use App\Entity\Vehicle;
use App\Form\VehicleType;
use App\Vehicle\Service\VehicleService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[IsGranted('ROLE_ADMIN')]
final class VehicleController extends AbstractController
{
    #[Route('/admin/vehicle/new', name: 'app_admin_vehicle_new')]
    public function new(
        Request $request,
        VehicleService $vehicleService
    ): Response
    {
        $vehicle = new Vehicle();

        $form = $this->createForm(VehicleType::class, $vehicle);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $vehicleService->create($vehicle);

            $this->addFlash('success', 'Vehicle created.');

            return $this->redirectToRoute('app_admin_dashboard');
        }

        return $this->render('admin/vehicle/new.html.twig', [
            'form' => $form->createView()
        ]);
    }

    #[Route('/admin/vehicle/{id}/edit', name: 'app_admin_vehicle_edit', methods: ['GET','POST'])]
    public function edit(
        Request $request,
        Vehicle $vehicle,
        VehicleService $vehicleService
    ): Response {

        $form = $this->createForm(VehicleType::class, $vehicle);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

           $vehicleService->update($vehicle);

            $this->addFlash('success', 'Vehicle updated');

            return $this->redirectToRoute('app_admin_dashboard');

        }

        return $this->render('admin/vehicle/edit.html.twig', [
            'form' => $form->createView(),
            'vehicle' => $vehicle
        ]);
    }


}
