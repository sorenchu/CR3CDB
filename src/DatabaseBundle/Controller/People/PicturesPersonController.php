<?php
# src/DatabaseBundle/Controller/People/PicturesPersonController.php

namespace DatabaseBundle\Controller\People;

use DatabaseBundle\Form\Person\PicturesType;
use DatabaseBundle\Repository\PersonalDataRepository;

use DatabaseBundle\Entity\Pictures;
use DatabaseBundle\Entity\PersonalData;
use DatabaseBundle\Entity\Season;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PicturesPersonController extends Controller
{
    public function editPicturesAction($id, Request $request)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $personalData = $entityManager->getRepository(PersonalData::class)->find($id);
        $pictures = $entityManager->getRepository(Pictures::class)->getPictures($id);
        if ($pictures == NULL) {
            $pictures = new Pictures();
        }
        $personalData->setPictures($pictures);
        $pictures->setPersonalData($personalData);
        $picturesForm = $this->createForm(PicturesType::class, $pictures);
        $picturesForm->handleRequest($request);
        if ($picturesForm->isSubmitted()) {
            $this->uploadPictures($pictures);
            $personalData->setPictures($pictures);
            $pictures->setPersonalData($personalData);
            $entityManager->getRepository(PersonalData::class)->savePerson($personalData, true);
            $picturesForm = $this->createForm(PicturesType::class, $pictures);
        }
        return $this->render('DatabaseBundle:person:editpictures.html.twig', array(
            'picturesForm' => $picturesForm->createView(),
            'personalData' => $personalData,
            'pictures' => $pictures,
            'season' => $entityManager->getRepository(Season::class)->getDefaultSeason(),
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
