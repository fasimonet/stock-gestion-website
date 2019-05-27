<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationType;

use Doctrine\Common\Persistence\ObjectManager;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface; 

class SecurityController extends AbstractController
{
    /**
     * @Route("/admin/inscription", name="security_registration")
     * @Route("/admin/inscription/{id}/edit", name="edit_security_registration")
     * @return Response
     */
    public function registration(Request $request, ObjectManager $manager, UserPasswordEncoderInterface $encoder, User $user = null): Response
    {
        if(!$user) {
            $user = new User();
        }
        $form = $this->createForm(RegistrationType::class, $user);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {

            $hash = $encoder->encodePassword($user, $user->getPassword());
            $user->setPassword($hash);

            if ($user->getStatus()->getTitle() == 'Professeur') {
                $user->setRoles('ROLE_ADMIN');
            }
            else {
                $user->setRoles('ROLE_USER');
            }

            $manager->persist($user);
            $manager->flush();

            return $this->redirectToRoute('user_pannel');
        }

        return $this->render('security/registration.html.twig', [
            'form' => $form->createView(),
            'editMode' => $user->getId() !== null,
            'current_menu' => 'user_management'
        ]);
    }

    /**
     * @Route("/connection", name="security_login")
     */
    public function login() {
        return $this->render('security/login.html.twig');
    }

    /**
     * @Route("/disconnection", name="security_logout")
     */
    public function logout() {}
}
