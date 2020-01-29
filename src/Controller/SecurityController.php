<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
  /**
  * @Route("/login", name="login", methods={"GET", "POST"})
  */
  public function login(AuthenticationUtils $authenticationUtils)
  {
    // get the login error if there is one
    $error = $authenticationUtils->getLastAuthenticationError();

    // last username entered by the user
    $lastUsername = $authenticationUtils->getLastUsername();

    return $this->render('security/login.html.twig', [
      'last_username' => $lastUsername,
      'error'         => $error,
    ]);
  }

  /**
  * @Route("/forgotpassword", name="forgotpassword")
  */
  public function forgotPassword()
  {

    return $this->render('security/forgotpassword.html.twig');
  }
  /**
   * @Route("/logout", name="app_logout", methods={"GET"})
   */
  public function logout()
  {

  }

}
