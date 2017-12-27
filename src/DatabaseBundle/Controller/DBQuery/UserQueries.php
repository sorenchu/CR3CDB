<?php
# src/DatabaseBundle/Controller/DBQuery/UserQueries.php

namespace DatabaseBundle\Controller\DBQuery;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class UserQueries extends Controller
{
    private $adminController;

    public function __construct($adminController)
    {
        $this->adminController = $adminController;
    }

    public function saveUser($user)
    {
        $em = $this->adminController->getDoctrine()->getManager();
        $em->persist($user);
        $em->flush();
    } 

    public function getUsers()
    {
        return ($this->adminController
                ->getDoctrine()
                ->getRepository('DatabaseBundle:User')
                ->findAll());
    }

    public function getUserInfoById($id)
    {
        $em = $this->adminController->getDoctrine()->getManager();
        $user = $em->getRepository('DatabaseBundle:User')
            ->find($id);
        return $user;
    }

    public function getUserInfoByUsername($username)
    {
        $em = $this->adminController->getDoctrine()->getManager();
        $repository = $em->getRepository('DatabaseBundle:User');
        return $repository->loadUserByUsername($username);
    }

    public function deleteUser($id)
    {
        $em = $this->adminController->getDoctrine()->getManager();
        $user = $em->getRepository('DatabaseBundle:User')
            ->find($id);
        if (0 == strcmp("admin", $user->getUsername())) {
            return false;
        }
        $em->remove($user);
        $em->flush();
        return true;
    }

    public function encodePassword($user, $password)
    {
        $encoder = $this->adminController->container->get('security.password_encoder');
        $encoded = $encoder->encodePassword($user, $password);
        $user->setPassword($encoded);
        return $user;
    }
}
