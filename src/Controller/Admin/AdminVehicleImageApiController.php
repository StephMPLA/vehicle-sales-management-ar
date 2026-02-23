<?php

namespace App\Controller\Admin;

use App\Entity\Vehicle;
use App\Entity\VehicleImage;
use App\Enum\VehicleImageType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Component\Security\Csrf\CsrfTokenManagerInterface;

#[Route('/admin/api/vehicle-images')]
#[IsGranted('ROLE_ADMIN')]
final class AdminVehicleImageApiController extends AbstractController
{
    public function __construct(
        private CsrfTokenManagerInterface $csrfTokenManager
    ) {}
    #[Route('/{id}/upload', name: 'app_admin_vehicle_image_upload', methods: ['POST'])]
    public function uploadImageAjax(
        Request $request,
        Vehicle $vehicle,
        EntityManagerInterface $em
    ): JsonResponse {
        $csrf = $request->headers->get('X-CSRF-TOKEN', '');
        if (!$this->isCsrfTokenValid('vehicle_image_upload', $csrf)) {
            return $this->json(['ok' => false, 'error' => 'Invalid CSRF token'], 403);
        }

        /** @var UploadedFile|null $file */
        $file = $request->files->get('file');
        if (!$file) {
            return $this->json(['ok' => false, 'error' => 'No file received'], 400);
        }

        $typeString = (string) $request->request->get('type', 'Detail');

        $typeEnum = VehicleImageType::tryFrom($typeString);
        if ($typeEnum === null) {
            $typeEnum = VehicleImageType::DETAIL;
        }

        $allowedExt = ['jpg', 'jpeg', 'png', 'webp'];
        $ext = strtolower($file->guessExtension() ?: $file->getClientOriginalExtension());

        if (!in_array($ext, $allowedExt, true)) {
            return $this->json(['ok' => false, 'error' => 'Invalid file type'], 400);
        }

        $filename = uniqid('', true) . '.' . $ext;

        $file->move(
            $this->getParameter('kernel.project_dir') . '/public/uploads/vehicles',
            $filename
        );

        $image = new VehicleImage();
        $image->setVehicle($vehicle);
        $image->setPath('/uploads/vehicles/' . $filename);
        $image->setType($typeEnum);

        $em->persist($image);
        $em->flush();

        $html = $this->renderView(
            'admin/vehicle/components/_vehicle_image_card.html.twig',
            [
                'image' => $image
            ]
        );
        return $this->json([
            'ok' => true,
            'html' => $html
        ]);
    }
    #[Route('/images/{id}/delete', name: 'app_admin_vehicle_image_delete_ajax', methods: ['POST'])]
    public function deleteImageAjax(
        Request $request,
        VehicleImage $image,
        EntityManagerInterface $em
    ): JsonResponse {
        $csrf = $request->headers->get('X-CSRF-TOKEN', '');
        if (!$this->isCsrfTokenValid('vehicle_image_delete_'.$image->getId(), $csrf)) {
            return $this->json(['ok' => false, 'error' => 'Invalid CSRF token'], 403);
        }

        $full = $this->getParameter('kernel.project_dir') . '/public' . $image->getPath();
        if (is_file($full)) {
            @unlink($full);
        }

        $em->remove($image);
        $em->flush();

        return $this->json(['ok' => true]);
    }
}
