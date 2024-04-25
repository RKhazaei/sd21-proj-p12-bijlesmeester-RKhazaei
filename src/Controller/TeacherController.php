<?php

namespace App\Controller;

use App\Entity\Lesson;
use App\Form\LessonType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class TeacherController extends AbstractController
{
    #[Route('/teacherhome', name: 'app_home_teacher')]
    public function lessons(EntityManagerInterface $em): Response
    {

        $lesson = $em->getRepository(Lesson::class)->findAll();


        return $this->render('teacher/home.html.twig', [
            'lessons' => $lesson,
        ]);
    }

    #[Route(path: '/lessonadd', name: 'app_add_lesson')]
    public function addlesson( Request $request, EntityManagerInterface $em): Response
    {
        $add = new Lesson();

        $form = $this->createForm(LessonType::class, $add);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // $form->getData() holds the submitted values
            // but, the original `$task` variable has also been updated
            $add = $form->getData();
            $em->persist($add);
            $em->flush();

            return $this->redirectToRoute('app_home_teacher');
        }

        return $this->render('teacher/addlesson.html.twig', [
            'form' => $form,
        ]);
    }

    #[Route('/delete/{id}', name: 'app_delete_lesson')]
    public function deletelesson(EntityManagerInterface $em,int $id): Response
    {

        $lesson = $em->getRepository(Lesson::class)->find($id);
        $em->remove($lesson);
        $em->flush();

        return $this->redirect('/teacherhome');
    }

    #[Route('/update/{id}', name: 'app_update_lesson')]
    public function updatelesson(EntityManagerInterface $em,int $id, Request $request): Response
    {

        $lesson = $em->getRepository(Lesson::class)->find($id);
        $form = $this->createForm(LessonType::class, $lesson);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // $form->getData() holds the submitted values
            // but, the original `$task` variable has also been updated
            $task = $form->getData();
            $em->flush();
            // ... perform some action, such as saving the task to the database

            return $this->redirectToRoute('app_home_teacher');
        }

        return $this->render('teacher/addlesson.html.twig', [
            'form' => $form,
        ]);
    }


}
