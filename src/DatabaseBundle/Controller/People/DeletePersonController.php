<?php
# src/DatabaseBundle/Controller/People/DeletePersonController.php

namespace DatabaseBundle\Controller\People;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DeletePersonController extends Controller {

    public function deletePersonAction($id) {
        $em = $this->getDoctrine()->getManager();
        $em->getRepository(PersonalData::class)
            ->deletePerson($id);
        return $this->redirectToRoute(
                'show_all',
                ['page' => 1]
        );
    }

}
