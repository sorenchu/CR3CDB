<?php
# src/DatabaseBundle/Controller/Import/ImportFile.php

namespace DatabaseBundle\Controller\Import;

use DatabaseBundle\Entity\FileImport;
use DatabaseBundle\Form\Import\FileImportType;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

class ImportFileController extends Controller
{
  public function importAction(Request $request)
  {
    $success = null;

    $fileImport = new FileImport();
    $fileImportForm = $this->createForm(new FileImportType(), $fileImport);
    $fileImportForm->handleRequest($request);

    if($fileImportForm->isSubmitted())
    {
      $success = $this->mapCsvToTables($fileImport);
    }

    return $this->render('DatabaseBundle:import:importing.html.twig', array(
                'fileImportForm' => $fileImportForm->createView(),
                'success' => $success,
    ));
  }

  private function uploadFile($fileImport)
  {
    $file = $fileImport->getPathToFile();
    $fileName = md5(uniqid().'.'.$file->guessExtension());

    $file->move($this->getParameter('imported_directory'),
                  $fileName);
    $fileImport->setPathToFile($this->getParameter('imported_directory').'/'.$fileName);
  }

  private function executeParser($fileImport)
  {
    // TODO: get relative path
    if ('personalData' == $fileImport->getContent()) 
    {
      $pathToScript = '/home/antonio/Projects/CR3CDB/src/DatabaseBundle/Controller/Import/personalData.py';
    }
    else
    {
      $pathToScript = '/home/antonio/Projects/CR3CDB/src/DatabaseBundle/Controller/Import/playerData.py';
    }
    $script = 'python '.$pathToScript;
    $process = new Process($script.' '.$fileImport->getPathToFile());
    $process->run();

    if ($process->isSuccessful()) {
        return true;
    }
    return false;
  }

  private function mapCsvToTables($fileImport)
  {
    $this->uploadFile($fileImport);
    return $this->executeParser($fileImport); 
  }
}
?>
