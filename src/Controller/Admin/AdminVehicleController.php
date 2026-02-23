<?php

namespace App\Controller\Admin;

use App\Entity\Vehicle;
use App\Form\VehicleType;
use App\Vehicle\Service\VehicleService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Component\Security\Csrf\CsrfTokenManagerInterface;

#[Route('/admin/vehicle', name: 'app_admin_vehicle_')]
#[IsGranted('ROLE_ADMIN')]
final class AdminVehicleController extends AbstractController
{
    #[Route('/new', name: 'new', methods: ['GET', 'POST'])]
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

    #[Route('/{id}/edit', name: 'edit', methods: ['GET','POST'])]
    public function edit(
        Request $request,
        Vehicle $vehicle,
        VehicleService $vehicleService,
        CsrfTokenManagerInterface $csrfTokenManager
    ): Response {

        $form = $this->createForm(VehicleType::class, $vehicle);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            /** @var UploadedFile|null $modelFile */
            $modelFile = $form->get('model3dFile')->getData();

            $vehicleService->update(
                $vehicle,
                [],
                $modelFile
            );

            $this->addFlash('success', 'Vehicle updated');

            return $this->redirectToRoute(
                'app_admin_vehicle_edit',
                ['id' => $vehicle->getId()]
            );
        }

        return $this->render('admin/vehicle/edit.html.twig', [
            'form' => $form->createView(),
            'vehicle' => $vehicle,
            'uploadCsrf' => $csrfTokenManager
                ->getToken('vehicle_image_upload')
                ->getValue(),
        ]);
    }
}
