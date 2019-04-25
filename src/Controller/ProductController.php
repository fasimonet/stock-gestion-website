<?php

namespace App\Controller;

use App\Entity\Product;
use App\Form\ProductType;
use App\Repository\ProductRepository;

use Doctrine\Common\Persistence\ObjectManager;

use Knp\Component\Pager\PaginatorInterface;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    /**
     * @Route("/pole_plurimedia", name="site")
     * @return Response
     */
    public function index(ProductRepository $repo, PaginatorInterface $paginator, Request $request): Response
    {
        $all_products = $paginator->paginate(
            $repo->findAll(),
            $request->query->getInt('page', 1),
            12
        );

        return $this->render('site/index.html.twig', [
            'controller_name' => 'SiteController',
            'all_products' => $all_products
        ]);
    }

    /**
     * @Route("/pole_plurimedia/product_sheet/{id}", name="product_sheet")
     * @return Response
     */
    public function product_sheet(Product $product): Response
    {
        return $this->render('site/product_sheet.html.twig', [
            'product' => $product
        ]);
    }

    /**
     * @Route("/pole_plurimedia/create_product", name="create_product")
     * @Route("/pole_plurimedia/product_sheet/{id}/edit", name="edit_product")
     * @return Response
     */
    public function form_product(Product $product = null, Request $request, ObjectManager $manager): Response
    {
        if(!$product)
        {
            $product = new Product();
        }

        $form = $this->createForm(ProductType::class, $product);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $manager->persist($product);
            $manager->flush();

            return $this->redirectToRoute('site');
        }

        return $this->render('site/create_product.html.twig', [
            'formProductCreation' => $form->createView(),
            'editMode' => $product->getId() !== null
        ]);
    }

    /**
     * @Route("/pole_plurimedia/product/{id}/delete", name="delete_product")
     * @return Response
     */
    public function delete_product(Product $product, ObjectManager $manager): Response
    {
        $manager->remove($product);
        $manager->flush();

        return $this->redirectToRoute('site');
    }
}
