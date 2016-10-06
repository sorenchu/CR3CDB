<?php

namespace DatabaseBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DefaultController extends Controller
{
    /**
     * @Route("/holi")
     */
    public function indexAction()
    {
        return $this->render('DatabaseBundle:Default:index.html.twig');
    }
}
