<?php
# src/DatabaseBundle/Controller/Default.php

namespace DatabaseBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
  public function loginAction()
  {
    $authenticationUtils = $this->get('security.authentication_utils');

    // get the login error if there is one
    $error = $authenticationUtils->getLastAuthenticationError();

    // last username entered by the user
    $lastUsername = $authenticationUtils->getLastUsername();

    return $this->render('security/login.html.twig', array(
        'last_username' => $lastUsername,
        'error'         => $error,
    ));
  }

  public function adminAction()
  {
    return new Response('<html><body>Admin page!</body></html>');
  }

  public function logoutAction()
  {
    $this->get('security.context')->setToken(null);
    $this->get('request')->getSession()->invalidate();
    return $this->redirectToRoute('show_all');
  }
} 
?>
