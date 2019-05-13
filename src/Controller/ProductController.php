<?php

namespace App\Controller;

use App\Entity\Category;
use App\Entity\Product;
use App\Entity\ProductSearch;
use App\Form\ProductType;
use App\Form\ProductSearchType;
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
     * @var ProductRepository
     */
    private $repo;

    /**
     * @var ObjectManager
     */
    private $manager;

    public function __construct(ProductRepository $repo, ObjectManager $manager)
    {
        $this->repo = $repo;
        $this->manager = $manager;
    }

    /**
     * @Route("/pole_plurimedia", name="site")
     * @return Response
     */
    public function index(PaginatorInterface $paginator, Request $request): Response
    {
        $search = new ProductSearch();
        $search_form = $this->createForm(ProductSearchType::class, $search);
        $search_form->handleRequest($request);

        $category=$this->manager->getRepository(Category::class)->find(6);
        dump($category);

        $all_products = $paginator->paginate(
            $this->repo->findAllWithSearchManagement($search),
            $request->query->getInt('page', 1),
            12
        );

        return $this->render('site/index.html.twig', [
            'controller_name' => 'SiteController',
            'all_products' => $all_products,
            'current_menu' => 'stock_management',
            'search_form' => $search_form->createView()
        ]);
    }

    /**
     * @Route("/pole_plurimedia/product_sheet/{id}", name="product_sheet")
     * @return Response
     */
    public function product_sheet(Product $product): Response
    {
        return $this->render('site/product_sheet.html.twig', [
            'product' => $product,
            'current_menu' => 'stock_management'
        ]);
    }

    /**
     * @Route("/pole_plurimedia/create_product", name="create_product")
     * @Route("/pole_plurimedia/product_sheet/{id}/edit", name="edit_product")
     * @return Response
     */
    public function form_product(Product $product = null, Request $request): Response
    {
        if(!$product)
        {
            $product = new Product();
        }

        $form = $this->createForm(ProductType::class, $product);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $this->manager->persist($product);
            $this->manager->flush();

            return $this->redirectToRoute('site');
        }

        return $this->render('site/create_product.html.twig', [
            'formProductCreation' => $form->createView(),
            'editMode' => $product->getId() !== null,
            'current_menu' => 'stock_management'
        ]);
    }

    /**
     * @Route("/pole_plurimedia/product/{id}/delete", name="delete_product")
     * @return Response
     */
    public function delete_product(Product $product): Response
    {
        $this->manager->remove($product);
        $this->manager->flush();

        return $this->redirectToRoute('site');
    }

    /**
     * @Route("/pole_plurimedia/search_product", name="search_product")
     * @return Response
     */
    public function search_product(PaginatorInterface $paginator, Request $request): Response
    {
        $all_products = $paginator->paginate(
            $this->repo->findBy(
                ['name' => 'Best product of the world'] 
            ),
            $request->query->getInt('page', 1),
            12
        );

        return $this->render('site/index.html.twig', [
            'controller_name' => 'SiteController',
            'all_products' => $all_products,
            'current_menu' => 'stock_management',
        ]);
    }
}
