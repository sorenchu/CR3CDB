<?php
# src/DatabaseBundle/Controller/People/PicturesPersonController.php

namespace DatabaseBundle\Controller\People;

use DatabaseBundle\Entity\Pictures;
use DatabaseBundle\Form\Person\PicturesType;

use DatabaseBundle\Controller\DBQuery\GetEditionQueries;
use DatabaseBundle\Controller\DBQuery\SeasonQueries;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PicturesPersonController extends Controller
{
    private $peopleQueries;

    public function editPicturesAction($id, Request $request)
    {
        $this->peopleQueries = new GetEditionQueries($this);
        $personalData = $this->peopleQueries->getPerson($id);
        $pictures = $this->peopleQueries->getPictures($id);
        if ($pictures == NULL) {
            $pictures = new Pictures();
        }
        $personalData->setPictures($pictures);
        $pictures->setPersonalData($personalData);
        $picturesForm = $this->createForm(\DatabaseBundle\Form\Person\PicturesType::class, $pictures);
        $picturesForm->handleRequest($request);
        if ($picturesForm->isSubmitted()) {
            $this->uploadPictures($pictures);
            $personalData->setPictures($pictures);
            $pictures->setPersonalData($personalData);
            $this->peopleQueries->savePerson($personalData, true);
            $picturesForm = $this->createForm(\DatabaseBundle\Form\Person\PicturesType::class, $pictures);
        }
        $seasonQueries = new SeasonQueries($this);
        return $this->render('DatabaseBundle:person:editpictures.html.twig', array(
            'picturesForm' => $picturesForm->createView(),
            'personalData' => $personalData,
            'pictures' => $pictures,
            'season' => $seasonQueries->getDefaultSeason(),
            ));
    }

    private function uploadPictures($pictures)
    {
        $frontDni = $pictures->getFrontDni();
        $newfile = $this->uploadPicture($frontDni);
        $pictures->setFrontDni( new \Symfony\Component\HttpFoundation\File\UploadedFile($newfile, $frontDni) );

        $backDni = $pictures->getBackDni();
        $newfile = $this->uploadPicture($backDni);
        $pictures->setBackDni( new \Symfony\Component\HttpFoundation\File\UploadedFile($newfile, $backDni) );

        $familyBook = $pictures->getFamilyBook();
        $newfile = $this->uploadPicture($familyBook);
        $pictures->setFamilyBook( new \Symfony\Component\HttpFoundation\File\UploadedFile($newfile, $familyBook) );

        $healthCareCard = $pictures->getHealthCareCard();
        $newfile = $this->uploadPicture($healthCareCard);
        $pictures->setHealthCareCard( new \Symfony\Component\HttpFoundation\File\UploadedFile($newfile, $healthCareCard) );
    }

    private function uploadPicture($picture)
    {
        $filename = md5(uniqid().'.'.$picture->guessExtension()).'.jpg';
        $folder = $this->container->getparameter('kernel.root_dir').'/../web/pictures';
        $picture->move($folder, $filename);
        return $folder.'/'.$filename;
    }
}
?>
