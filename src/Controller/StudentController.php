<?php

namespace App\Controller;

use App\Entity\Category;
use App\Entity\Lesson;
use App\Entity\Product;
use App\Entity\Purchase;
use App\Entity\Purchaseline;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
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
    public function makeOrder(EntityManagerInterface $em,Request $request, int $id): Response
    {
        $product=$em->getRepository(Product::class)->find($id);
        $form = $this->createFormBuilder()
            ->add('amount', IntegerType::class, [
                'required'=>true,
                'data'=>1,
                'label'=>'aantal'
            ])
            ->add('save', SubmitType::class)
            ->getForm();

        $session=$request->getSession();
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid() ) {
            //als de variabele order in de sesion array niet bestaat maak deze aan
            if(!$session->get('order')) {
                $session->set('order',[]);
            }
            $amount=$form->get('amount')->getData();
            //haal sessie op en voeg orderline toe
            $order=$session->get('order');
            $order[]=[$id,$amount];
            $session->set('order',$order);
            $this->addFlash('success','product toegevoegd!');
            return $this->redirectToRoute('app_purchaseline');
        }
        return $this->render('student/product.html.twig',[
            'product'=>$product,
            'form'=>$form
        ]);
    }

    #[Route('/purchaseline', name: 'app_purchaseline')]
    public function purchaseline(EntityManagerInterface $em,Request $request): Response
    {
        $order = $request->getSession()->get('order');
        if (!$order) {
            $this->addFlash('danger', 'je hebt geen producten');
        }
            $purchaseLines = [];
            foreach ($order as $orderLine) {
                $purchaseLine = new Purchaseline();
                $product = $em->getRepository(Product::class)->find($orderLine[0]);
                $purchaseLine->setProduct($product);
                $purchaseLine->setAmount($orderLine[1]);
                $purchaseLines [] = $purchaseLine;
            }


//        dd($purchaseLines);
        return $this->render('student/order.html.twig', [
            'purchaseLines' => $purchaseLines
        ]);
    }

    #[Route('/lessons', name: 'app_lessons')]
    public function lessons(EntityManagerInterface $em): Response
    {

        $lesson = $em->getRepository(Lesson::class)->findAll();


        return $this->render('student/Lessons.html.twig', [
            'lessons' => $lesson,
        ]);
    }
    #[Route('/order',name:'app_order')]
    public function getProducts(EntityManagerInterface $em): Response
    {
        $products=$em->getRepository(Product::class)->findAll();


        return $this->render('student/order.html.twig',[
            'products'=>$products
        ]);
    }



}
