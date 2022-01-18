<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
class LoginController extends AbstractController
{
    /**
     * @Route("/login", name="login")
     */

    public function index(AuthenticationUtils $authenticationUtils): Response
    {
//        if($this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY')){
//            return $this->redirectToRoute('');
//        }
        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();

        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

//    var_dump($lastUsername);
        return $this->render('login.html.twig', [
            'last_username' => $lastUsername,
            'error' => $error,
        ]);


    }
}


