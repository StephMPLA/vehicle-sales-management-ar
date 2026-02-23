<?php

namespace App\Controller\Admin;

use App\Entity\Vehicle;
use App\Repository\VehicleRepository;
use App\Service\VehicleService;
use Doctrine\ORM\EntityManagerInterface;
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
#[IsGranted('ROLE_ADMIN')]
final class AdminVehicleApiController extends AbstractController
{
    /**
     * Deletes a vehicle and flushes persistence.
     */
    #[Route('/{id}', methods: ['DELETE'])]
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

    /**
     * Deletes model3D vehicle and flushes persistence.
     */
    #[Route('/{id}/model', name: 'admin_vehicle_model_delete', methods: ['DELETE'])]
    public function deleteModel(
        Request $request,
        Vehicle $vehicle,
        EntityManagerInterface $em
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

        if (!$vehicle->getModel3dPath()) {
            return $this->json([
                'ok' => false,
                'error' => 'No model'
            ]);
        }

        $fullPath =
            $this->getParameter('kernel.project_dir')
            . '/public'
            . $vehicle->getModel3dPath();

        if (is_file($fullPath)) {
            unlink($fullPath);
        }

        $vehicle->setModel3dPath(null);

        $em->flush();

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
    #[Route('/{id}/model', name: 'admin_vehicle_model_state', methods: ['GET'])]
    public function modelState(Vehicle $vehicle): JsonResponse
    {
        return $this->json([
            'hasModel' => $vehicle->getModel3dPath() !== null,
            'path' => $vehicle->getModel3dPath()
        ]);
    }
    #[Route('/{id}/model', name: 'admin_vehicle_model_upload', methods: ['POST'])]
    public function uploadModel(
        Request $request,
        Vehicle $vehicle,
        EntityManagerInterface $em
    ): JsonResponse {

        /** @var UploadedFile|null $file */
        $file = $request->files->get('file');

        if (!$file) {
            return $this->json([
                'ok' => false,
                'error' => 'No file uploaded'
            ], Response::HTTP_BAD_REQUEST);
        }

        if ($file->getClientOriginalExtension() !== 'glb') {
            return $this->json([
                'ok' => false,
                'error' => 'Invalid format'
            ], Response::HTTP_BAD_REQUEST);
        }

        $filename = uniqid().'.glb';

        $uploadDir = $this->getParameter('kernel.project_dir')
            . '/public/uploads/models';

        $file->move($uploadDir, $filename);

        /*
         * delete old model if exists
         */
        if ($vehicle->getModel3dPath()) {

            $old =
                $this->getParameter('kernel.project_dir')
                . '/public'
                . $vehicle->getModel3dPath();

            if (is_file($old)) {
                unlink($old);
            }
        }

        $vehicle->setModel3dPath(
            '/uploads/models/'.$filename
        );

        $em->flush();

        return $this->json([
            'ok' => true,
            'path' => $vehicle->getModel3dPath()
        ]);
    }
}
