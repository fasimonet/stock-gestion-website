<?php

namespace App\Controller;

use Doctrine\Common\Persistence\ObjectManager;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController {

    /**
     * @Route("/", name="home")
     * @return Response
     */
    public function index(Request $request, ObjectManager $manager): Response
    {
        return $this->render('site/home.html.twig', [
            'current_menu' => 'home',
        ]);
    }

}