<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\UserSearch;
use App\Form\UserSearchType;
use App\Repository\UserRepository;

use Doctrine\Common\Persistence\ObjectManager;

use Knp\Component\Pager\PaginatorInterface;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    public function __construct(UserRepository $repo, ObjectManager $manager)
    {
        $this->repo = $repo;
        $this->manager = $manager;
    }

    /**
     * @Route("/pole_plurimedia/user_pannel", name="user_pannel")
     * @return Response
     */
    public function index(PaginatorInterface $paginator, Request $request): Response
    {
        $search = new UserSearch();
        $search_form = $this->createForm(UserSearchType::class, $search);
        $search_form->handleRequest($request);

        $users = $paginator->paginate(
            $this->repo->findAllWithSearchManagement($search),
            $request->query->getInt('page', 1),
            12
        );

        return $this->render('site/user_pannel.html.twig', [
            'controller_name' => 'SiteController',
            'users' => $users,
            'current_menu' => 'user_management',
            'search_form' => $search_form->createView()
        ]);
    }
 
    /**
     * @Route("/pole_plurimedia/user_pannel/{id}/delete", name="delete_user")
     * @return Response
     */
    public function delete_user(User $user): Response
    {
        $manager->remove($user);
        $manager->flush();

        return $this->redirectToRoute('user_pannel');
    }

    /**
     * @return Response
     */
    public function form_user(User $user = null, Request $request): Response
    {
        if(!$user)
        {
            $user = new User();
        }
    }  
}
