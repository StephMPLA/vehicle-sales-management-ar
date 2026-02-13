<?php

namespace App\Controller\Admin;

use App\Entity\Vehicle;
use App\Form\VehicleType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

final class VehicleController extends AbstractController
{
    #[Route('/admin/vehicle/new', name: 'app_admin_vehicle_new')]
    #[IsGranted('ROLE_ADMIN')]
    public function new(Request $request, EntityManagerInterface $em): Response
    {
        $vehicle = new Vehicle();

        $form = $this->createForm(VehicleType::class, $vehicle);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $em->persist($vehicle);
            $em->flush();

            $this->addFlash('success', 'Vehicle created.');

            return $this->redirectToRoute('app_admin_dashboard');
        }

        return $this->render('admin/vehicle/new.html.twig', [
            'form' => $form->createView()
        ]);
    }

    #[Route('/admin/vehicle/{id}/delete', name: 'app_admin_vehicle_delete', methods: ['POST'])]
    public function delete(
        Request $request,
        Vehicle $vehicle,
        EntityManagerInterface $em
    ): Response {

        if ($this->isCsrfTokenValid('delete_vehicle_'.$vehicle->getId(), $request->request->get('_token'))) {

            $em->remove($vehicle);
            $em->flush();

            $this->addFlash('success', 'Vehicle deleted');
        }

        return $this->redirectToRoute('app_admin_dashboard');
    }


}
