<?php
# src/DatabaseBundle/Controller/Season/SeasonController.php

namespace DatabaseBundle\Controller\Season;

use DatabaseBundle\Form\Season\SeasonType;
use DatabaseBundle\Entity\Season;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class SeasonController extends Controller {

    function handleForm(int $id, Season $season, Request $request) {
        $seasonForm = $this->createForm(SeasonType::class, $season);
        $seasonForm->handleRequest($request);
        $seasonId = $seasonForm->get('season')->getData()->getId();
        if ($seasonForm->isSubmitted()) {
            return $this->redirectToRoute(
                    'edit_person',
                    array(
                        'id' => $id,
                        'seasonId' => $seasonId
                    )
            );
        }
        return new Response();
    }
}
