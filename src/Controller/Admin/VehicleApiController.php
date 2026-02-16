<?php

namespace App\Controller\Admin;

use App\Entity\Vehicle;
use App\Repository\VehicleRepository;
use App\Vehicle\Service\VehicleService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

/**
 * REST endpoint to delete a vehicle via AJAX.
 * Requires valid CSRF token.
 */
#[IsGranted('ROLE_ADMIN')]
final class VehicleApiController extends AbstractController
{
    /**
     * Deletes a vehicle and flushes persistence.
     */
    #[Route('/api/admin/vehicles/{id}', methods: ['DELETE'])]
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
    // Refresh KPI after successful delete to keep dashboard in sync
    #[Route('/api/admin/vehicles/count', methods: ['GET'])]
    public function count(VehicleRepository $repo): JsonResponse
    {
        return new JsonResponse([
            'count' => $repo->count([])
        ]);
    }
}
