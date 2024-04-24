<?php

namespace App\Controller;

use App\Entity\Category;
use App\Entity\Product;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class StudentController extends AbstractController
{
    #[Route('/login', name: 'app_student')]
    public function index(): Response
    {
        return $this->render('student/index.html.twig', [
            'controller_name' => 'StudentController',
        ]);
    }

    #[Route('/categories', name: 'categories')]
    public function categories(EntityManagerInterface $em): Response
    {

        $categories = $em->getRepository(Category::class)->findAll();


        return $this->render('student/categories.html.twig', [
            'categories' => $categories,
        ]);
    }
    #[Route('/products/{id}', name: 'app_products')]
    public function products(EntityManagerInterface $em, int $id): Response
    {

        $category = $em->getRepository(Category::class)->find($id);

        return $this->render('student/products.html.twig', [
            'category' => $category,
        ]);
    }
    #[Route('/product/{id}', name: 'app_product')]
    public function product(EntityManagerInterface $em, int $id): Response
    {

        $product = $em->getRepository(Product::class)->find($id);

        return $this->render('student/product.html.twig', [
            'product' => $product,
        ]);
    }



}
