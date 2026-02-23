<?php

namespace App\Controller\User;

use App\Entity\User;
use App\Form\UserProfileType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\CurrentUser;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[IsGranted('ROLE_USER')]
final class UserDashboardController extends AbstractController
{
    /*
    =========================
    USER DASHBOARD
    =========================
    */
    #[Route('/dashboard', name: 'app_user_dashboard')]
    public function dashboard(): Response
    {
        return $this->render('user/dashboard.html.twig');
    }

    /*
    =========================
    PROFILE EDIT
    =========================
    */
    #[Route('/dashboard/profile', name: 'app_user_profile')]
    public function profile(
        Request $request,
        #[CurrentUser] User $user,
        EntityManagerInterface $em
    ): Response {

        $form = $this->createForm(UserProfileType::class, $user);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();

            $this->addFlash('success', 'Profile updated');

            return $this->redirectToRoute('app_user_profile');
        }

        return $this->render('user/profile_edit.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
