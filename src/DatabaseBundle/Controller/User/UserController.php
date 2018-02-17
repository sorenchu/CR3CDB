<?php
# src/DatabaseBundle/Controller/User/UserController.php
namespace DatabaseBundle\Controller\User;

use DatabaseBundle\Entity\User;
use DatabaseBundle\Form\User\EditUserType;
use DatabaseBundle\Controller\DBQuery\UserQueries;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Validator\Constraints\UserPasswordValidator;

class UserController extends Controller
{
    private $userQueries;

    public function __construct()
    {
        $this->userQueries = new UserQueries($this);
    }

    public function changePasswordAction(Request $request)
    {
        $changed = false;
        $wrongPassword = false;

        $username = $this->get('security.token_storage')->getToken()->getUser()->getUsername();
        $user = $this->userQueries->getUserInfoByUsername($username);
        $factory = $this->container->get('security.encoder_factory');
        $encoder = $factory->getEncoder($user);
        $oldPwd = $this->get('security.token_storage')->getToken()->getUser()->getOldpassword();

        $editUserForm = $this->createForm(new EditUserType(), $user);
        $editUserForm->handleRequest($request);
        if ($editUserForm->isSubmitted()) {
            if ($encoder->isPasswordValid($oldPwd, $editUserForm->get('oldpassword')->getViewData(), $user->getSalt())) {
                $newuser = $this->userQueries->encodePassword($user, $user->getPassword());
                $this->userQueries->saveUser($newuser);
                $changed = true;
            } else {
                $wrongPassword = true;
            }
        }
        return $this->render('DatabaseBundle:user:edituser.html.twig',
                array('userData' => $editUserForm->createView(),
                    'changed' => $changed,
                    'wrongPassword' => $wrongPassword,
                    ));
    }
}
?>
