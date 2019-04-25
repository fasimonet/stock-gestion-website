<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;

use Doctrine\Common\Persistence\ObjectManager;

use Knp\Component\Pager\PaginatorInterface;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    /**
     * @Route("/pole_plurimedia/user_pannel", name="user_pannel")
     * @return Response
     */
    public function index(UserRepository $repo, PaginatorInterface $paginator, Request $request): Response
    {
        $users = $paginator->paginate(
            $repo->findAll(),
            $request->query->getInt('page', 1),
            12
        );

        return $this->render('site/user_pannel.html.twig', [
            'controller_name' => 'SiteController',
            'users' => $users
        ]);
    }

    /**
     * @Route("/", name="home")
     * @return Response
     */
    public function home(Request $request, ObjectManager $manager): Response
    {
        return $this->render('site/home.html.twig');
    }

   
    /**
     * @Route("/pole_plurimedia/user_pannel/{id}/delete", name="delete_user")
     * @return Response
     */
    public function delete_user(User $user, ObjectManager $manager): Response
    {
        $manager->remove($user);
        $manager->flush();

        return $this->redirectToRoute('user_pannel');
    }

    public function form_user(User $user = null, Request $request, ObjectManager $manager): Response
    {
        if(!$user)
        {
            $user = new User();
        }
    }  
}
