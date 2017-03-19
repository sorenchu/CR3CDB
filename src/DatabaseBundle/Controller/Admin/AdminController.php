<?php

# src/DatabaseBundle/Controller/Admin/AdminController.php

namespace DatabaseBundle\Controller\Admin;

use DatabaseBundle\Entity\User;
use DatabaseBundle\Form\UserDataType;

use DatabaseBundle\Controller\DBQuery\UserQueries;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminController extends Controller
{
  private $userQueries;

  public function __construct()
  {
    $this->userQueries = new UserQueries($this);
  }

  public function createUserAction(Request $request)
  {
    $user = new User();
    $userData = $this->createForm(new UserDataType(), $user);
    $userData->handleRequest($request);

    if ($userData->isSubmitted())
    {
      $this->userQueries->saveUser($user);
      return $this->redirectToRoute('edit_user', 
                  array('id' => $this->userQueries
                                      ->getNewUser($user)->getId()));
    }
    return $this->render('DatabaseBundle:admin:newuser.html.twig', array(
                'userData' => $userData->createView(),
    ));
  }

  public function showUsersAction()
  {
    $users = $this->userQueries->getUsers();
    return $this->render('DatabaseBundle:admin:showusers.html.twig', array(
                'userData' => $users));
  }

  // TODO: fulfill this action
  public function deleteUserAction()
  {

    return null;
  }

  // TODO: fulfill this action
  public function editUserAction()
  {

  }
}
?>
