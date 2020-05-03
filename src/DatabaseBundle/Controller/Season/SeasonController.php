<?php
# src/DatabaseBundle/Controller/Season/SeasonController.php

namespace DatabaseBundle\Controller\Season;

use DatabaseBundle\Form\Season\SeasonType;
use DatabaseBundle\Entity\Season;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class SeasonController extends Controller {

    function handleForm(int $id, Season $season, Request $request, $logger) {
        $seasonForm = $this->createForm(SeasonType::class, $season);
        $seasonForm->handleRequest($request);
$logger->info('patata '. $seasonForm->get('season')->getData()->getId());
        $seasonId = $seasonForm->get('season')->getData()->getId();
$logger->info('sison aidi '. $seasonId);
        if ($seasonForm->isSubmitted()) {
            $logger->info('redirecting '.$id.' '.$seasonId);
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
