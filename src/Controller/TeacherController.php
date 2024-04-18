<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class TeacherController extends AbstractController
{
    #[Route(path: '/Teacherhome', name: 'app_home_teacher')]
    public function index(): Response
    {
        return $this->render('teacher/home.html.twig');
    }

}
