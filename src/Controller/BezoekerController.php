<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegisterFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Doctrine\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Attribute\Route;


class BezoekerController extends AbstractController
{
//    #[Route('/bezoeker', name: 'app_bezoeker')]
//    public function index(): Response
//    {
//        return $this->render('bezoeker/index.html.twig', [
//            'controller_name' => 'BezoekerController',
//        ]);
//    }

    #[Route('/bezoeker', name: 'register')]
    public function register(Request $request, EntityManagerInterface $entityManager, UserPasswordHasherInterface $passwordHasher): Response
    {
        $user = new User();
        $form = $this->createForm(RegisterFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user = $form->getData();

            $user->setPassword($passwordHasher->hashPassword(
                $user,
                $user->getPassword()
            ));
            $user->setRoles(["ROLE_STUDENT"]);
            $entityManager->persist($user);
            $entityManager->flush();
            $this->addFlash('warning', 'U heeft zich geregistreerd bij ons. U kunt nu inloggen.');
            return $this->redirectToRoute('app_student');
        }
        return $this->render('bezoeker/index.html.twig', [
            'form' => $form,
        ]);
    }

}
