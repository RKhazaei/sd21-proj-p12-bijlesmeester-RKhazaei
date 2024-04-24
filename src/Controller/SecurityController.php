<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\HttpFoundation\RedirectResponse;

class SecurityController extends AbstractController
{
    #[Route(path: '', name: 'app_login')]
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();

        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', [
            'last_username' => $lastUsername,
            'error' => $error,
        ]);
    }


//    #[Route(path: '/home', name: 'app_home_teacher')]
//    public function home(): Response
//    {
//        return $this->render('teacher/home.html.twig');
//    }

    #[Route(path: '/logout', name: 'app_logout')]
    public function logout(): void
    {

        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }
    #[Route(path: '/redirect', name: 'redirect')]
    public function redirectAction(Security $security) {
        if ($security->isGranted('ROLE_ADMIN')) { return $this->redirectToRoute('app_login');}
        if ($security->isGranted('ROLE_STUDENT')) { return $this->redirectToRoute('app_student');}
        if ($security->isGranted('ROLE_TEACHER')) { return $this->redirectToRoute('app_home_teacher'); }

            return $this->redirectToRoute('app_login');
    }

}
