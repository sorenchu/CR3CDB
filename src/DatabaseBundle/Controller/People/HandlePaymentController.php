<?php
# src/DatabaseBundle/Controller/People/HandlePaymentController.php

namespace DatabaseBundle\Controller\People;

use DatabaseBundle\Form\Season\SeasonType;
use DatabaseBundle\Form\Person\ActivePaymentType;

use DatabaseBundle\Entity\PersonalData;
use DatabaseBundle\Entity\Payment;
use DatabaseBundle\Entity\Season;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class HandlePaymentController extends Controller
{
    private $em;

    public function showPaymentsAction($id, $seasonId, Request $request)
    {
        $this->em = $this->getDoctrine()->getManager();
        $season = $this->em->getRepository(Season::class)->find($seasonId);
        $seasonForm = $this->createForm(SeasonType::class, $season);
        $seasonForm->handleRequest($request);
        if ($seasonForm->isSubmitted()) {
            return $this->redirectToRoute('show_payments',
                    array('id' => $id,
                        'seasonId' => $seasonForm->get('season')
                        ->getData()->getId()
                        ));
        }

        $personalData = $this->em->getRepository(PersonalData::class)
                            ->find($id);
        $playerData = $personalData->getPlayerDataBySeason($season);
        $activePayments = $playerData->getPay()->getActivePayment();
        $paymentForms = array();
        foreach ($activePayments as $activePayment) {
            $paymentForm = $this->createForm(ActivePaymentType::class, $activePayment);
            array_push($paymentForms, $paymentForm);
        }
        $history = $this->em->getRepository(Payment::class)
                          ->getPaymentsGroupedByHistory();
        $hId = NULL;
        $pushing = NULL;
        $historyPayments = array();
        foreach ($history as $h) {
            if ($hId != $h->getPaymentHistory()->getId()) {
                if ($pushing != NULL) {
                    array_push($historyPayments, $pushing);
                }
                $hId = $h->getPaymentHistory()->getId();
                $pushing = array();
            }
            array_push($pushing, $h);
        }
        array_push($historyPayments, $pushing);

        return $this->render('DatabaseBundle:person:showpayments.html.twig', array(
                    'seasonForm' => $seasonForm->createView(),
                    'personalData' => $personalData,
                    'curSeason' => $season,
                    'playerData' => $playerData,
                    'activePayments' => $activePayments,
                    'paymentForms' => $paymentForms,
                    'historyPayments' => $historyPayments,
        ));
    }
}
?>
