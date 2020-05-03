<?php
# src/DatabaseBundle/Controller/People/Payment.php

namespace DatabaseBundle\Controller\People;

use DatabaseBundle\Controller\People\EditPersonController;
use DatabaseBundle\Entity\Payment;
use DatabaseBundle\Entity\PaymentHistory;
use DatabaseBundle\Entity\ActivePayment;

class PaymentHandler {

    private $entityManager;

    function __construct($entityManager) {
        $this->entityManager = $entityManager;
    }

    function addPayment($pay, $personalDataForm, $childEntity) {
        if ($pay->getActivePayment() === null) {
            return;
        }
        foreach($personalDataForm->get($childEntity.'Person') as $subForm) {
            $playerData = EditPersonController::getFormDataArray($subForm)[$childEntity.'Data'];
            foreach ($playerData->getPay()->getActivePayment() as $activePayment) {
                if (!$activePayment->getPay()) {
                    $history = new PaymentHistory();
                    $activePayment->setPay($pay);
                    $pm = ($activePayment->getPayment()) ?? new Payment();
                    $activePayment->setPayment($pm);
                    $pm->setPay($pay);
                    $history->addPayment($pm);
                    $pm->setPaymentHistory($history);
                    $pm->setActivePayment($activePayment);
                } else {
                    $pm = $activePayment->getPayment();
                    $originalData = $this->entityManager->getUnitOfWork()->getOriginalEntityData($pm);
                    if (!$pm->compareWithArray($originalData)) {
                        $originalPayment = new Payment();
                        $originalPayment->setPay(
                            $pm->getPay());
                        $originalPayment->setPaymentHistory(
                            $pm->getPaymentHistory());
                        $originalPayment->setPaymentDate(
                            $originalData['paymentDate']);
                        $originalPayment->setAmountPayed(
                            $originalData['amountPayed']);
                        $originalPayment->setStatus(
                            $originalData['status']);
                        $originalPayment->setPay($pay);
                        $pay->addPayment($originalPayment);
                        $pm->setPay($pay);
                    }
                }
            }
        }
    }

    function removePayment($pay, $personalDataForm) {
        $payments = $pay->getPayment();
        $repository = $this->entityManager->getRepository(Payment::class);
        $dbPayments = $repository->getPaymentsByPay($pay->getId());
        if ($payments->count() == sizeof($dbPayments)) {
            return;
        }
        foreach($payments as $payment) {
            foreach($dbPayments as $dbP) {
                if(!$payments->contains($dbP)) {
                    $pay->removePayment($dbP);
                    $repository->removePayment($dbP);
                }
            }
        }
    }
}
