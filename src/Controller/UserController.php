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
     * @Route("/admin/user_pannel", name="user_pannel")
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
     * @Route("/admin/user_pannel/{id}/delete", name="delete_user")
     * @return Response
     */
    public function delete_user(User $user): Response
    {
        $this->manager->remove($user);
        $this->manager->flush();

        return $this->redirectToRoute('user_pannel');
    }

      /**
     * @Route("/admin/user_pannel/{id}/history", name="user_history")
     * @return Response
     */
    public function display_user_history(User $user): Response
    {
        return $this->render('site/user_history.html.twig', [
            'user' => $user
        ]);
    }
}
