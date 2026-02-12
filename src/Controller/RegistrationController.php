<?php

namespace App\Controller;

use App\User\Entity\User;
use App\User\Form\RegistrationFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class RegistrationController extends AbstractController
{
    #[Route('/register', name: 'app_register')]
    public function register(Request $request,Security $security, EntityManagerInterface $entityManager): Response
    {
        $user = new User();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if (!empty($form->get('website')->getData())) {
                $this->addFlash('error', 'Invalid submission');
                return $this->redirectToRoute('app_register');
            }

//            /** @var string $plainPassword */
//            $plainPassword = $form->get('plainPassword')->getData();
//
//            // encode the plain password
//            $user->setPassword($userPasswordHasher->hashPassword($user, $plainPassword));
            $entityManager->persist($user);
            $entityManager->flush();

            // do anything else you need here, like send an email

//            return $security->login($user, 'form_login', 'main');
            $security->login($user, 'form_login', 'main');

            return $this->redirectToRoute('app_user_dashboard');
        }

        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form,
        ]);
    }
}
