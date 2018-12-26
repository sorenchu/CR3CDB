<?php
# src/DatabaseBundle/Controller/Admin/AdminController.php
namespace DatabaseBundle\Controller\Admin;

use DatabaseBundle\Entity\User;
use DatabaseBundle\Form\User\UserDataType;

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
        $userData = $this->createForm(UserDataType::class, $user);
        $userData->handleRequest($request);

        if ($userData->isSubmitted()) {
            $user = $this->userQueries->encodePassword($user, $user->getPassword());
            $this->userQueries->saveUser($user);
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
        $users = $this->userQueries->getUsers();
        return $this->render('DatabaseBundle:admin:showusers.html.twig', array(
                    'userData' => $users,
                    'deleted' => $deleted));
    }

    public function editUserAction($id, Request $request)
    {
        $user = $this->userQueries->getUserInfoById($id);
        $admin = false;
        if (strcasecmp($user->getUsername(), 'Admin') == 0) {
            $admin = true;
        }

        $userData = $this->createForm(new UserDataType($admin), $user);
        $userData->handleRequest($request);
        if ($userData->isSubmitted()) {
            $user = $this->userQueries->encodePassword($user, $user->getPassword());
            $this->userQueries->saveUser($user);
        }
        return $this->render('DatabaseBundle:admin:newuser.html.twig', array(
                    'userData' => $userData->createView(),
                    'edit' => true,
                    'admin' => $admin,
                    ));
    }
}
?>
