<?php

# src/DatabaseBundle/Controller/User/UserController.php

namespace DatabaseBundle\Controller\User;

use DatabaseBundle\Entity\User;
use DatabaseBundle\Form\EditUserType;
use DatabaseBundle\Controller\DBQuery\UserQueries;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
  private $currentUser;
  private $userQueries;

  public function __construct()
  {
    $this->userQueries = new UserQueries($this);
  }

  public function changePasswordAction(Request $request)
  {
    $changed = false;
    $username = $this->get('security.token_storage')->getToken()->getUser()->getUsername();
    $currentUser = $this->userQueries->getUserInfoByUsername($username);

    $editUserForm = $this->createForm(new EditUserType(), $currentUser);
    $editUserForm->handleRequest($request);
    if ($editUserForm->isSubmitted())
    {
      // TODO: verify if old password matches.
      $this->userQueries->saveUser($currentUser);
    }
    return $this->render('DatabaseBundle:user:edituser.html.twig',
            array('userData' => $editUserForm->createView(),
              'changed' => $changed
    ));
  }
}
?>
