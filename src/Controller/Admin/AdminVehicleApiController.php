<?php

namespace App\Controller\Admin;

use App\Entity\Vehicle;
use App\Repository\VehicleRepository;
use App\Service\Vehicle\VehicleService;
use Doctrine\ORM\EntityManagerInterface;
use Random\RandomException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

/**
 * REST endpoint to delete a vehicle via AJAX.
 * Requires valid CSRF token.
 */
#[Route('/api/admin/vehicles')]
final class AdminVehicleApiController extends AbstractController
{
    /**
     * Deletes a vehicle and flushes persistence.
     */
    #[Route('/{id}', requirements: ['id' => '\d+'], methods: ['DELETE'])]
    public function deleteApi(
        Vehicle $vehicle,
        Request $request,
        VehicleService $vehicleService
    ): JsonResponse {

        try {
            $data = json_decode(
                $request->getContent(),
                true,
                512,
                JSON_THROW_ON_ERROR
            );
        } catch (\JsonException $e) {
            return new JsonResponse(['error' => 'Invalid JSON'], 400);
        }

        $token = $data['_token'] ?? null;

        if (!$this->isCsrfTokenValid('delete_vehicle_'.$vehicle->getId(), $token)) {
            return new JsonResponse(['error' => 'Invalid CSRF'], 400);
        }

        $vehicleService->delete($vehicle);

        return new JsonResponse([
            'success' => true,
            'id' => $vehicle->getId()
        ]);
    }

    #[Route(
        '/{id}/model',
        name: 'admin_vehicle_model_delete',
        requirements: ['id' => '\d+'],
        methods: ['DELETE']
    )]
    public function deleteModel(
        Request $request,
        Vehicle $vehicle,
        VehicleService $service
    ): JsonResponse {

        $csrf = $request->headers->get('X-CSRF-TOKEN', '');

        if (!$this->isCsrfTokenValid(
            'delete_vehicle_model_'.$vehicle->getId(),
            $csrf
        )) {
            return $this->json([
                'ok' => false,
                'error' => 'Invalid CSRF'
            ], 403);
        }

        $service->deleteModel($vehicle);

        return $this->json(['ok' => true]);
    }

    /**
     * Refresh KPI after successful delete to keep dashboard in sync
     */
    #[Route('/count', methods: ['GET'])]
    public function count(VehicleRepository $repo): JsonResponse
    {
        return new JsonResponse([
            'count' => $repo->count([])
        ]);
    }

    #[Route('/{id}/model', name: 'admin_vehicle_model_state', requirements: ['id' => '\d+'], methods: ['GET'])]
    public function modelState(Vehicle $vehicle): JsonResponse
    {
        return $this->json([
            'hasModel' => $vehicle->getModel3dPath() !== null,
            'path' => $vehicle->getModel3dPath()
        ]);
    }

    /**
     * @throws RandomException
     */
    #[Route('/{id}/model', name: 'admin_vehicle_model_upload', requirements: ['id' => '\d+'], methods: ['POST'])]
    public function uploadModel(
        Request $request,
        Vehicle $vehicle,
        VehicleService $service
    ): JsonResponse {

        $file = $request->files->get('file');

        if (!$file) {
            return $this->json(['ok'=>false], 400);
        }

        $path = $service->uploadModel($vehicle, $file);

        return $this->json([
            'ok' => true,
            'path' => $path
        ]);
    }
}
