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
                  array('id' => $user->getId()));
    }
    return $this->render('DatabaseBundle:admin:newuser.html.twig', array(
                'userData' => $userData->createView(),
                'edit' => false,
    ));
  }

  public function showUsersAction()
  {
    $users = $this->userQueries->getUsers();
    return $this->render('DatabaseBundle:admin:showusers.html.twig', array(
                'userData' => $users));
  }

  public function deleteUserAction($id)
  {
    $deleted = $this->userQueries->deleteUser($id);
    return $this->showUsersAction();
  }

  public function editUserAction($id, Request $request)
  {
    $user = $this->userQueries->getUserInfo($id);
    $userData = $this->createForm(new UserDataType(), $user);
    $userData->handleRequest($request);

    if ($userData->isSubmitted())
    {
      $this->userQueries->saveUser($user);
    }
    return $this->render('DatabaseBundle:admin:newuser.html.twig', array(
                'userData' => $userData->createView(),
                'edit' => true,
    ));
  }
}
?>
