<?php
# src/DatabaseBundle/Controller/Searcher/SearcherController.php

namespace DatabaseBundle\Controller\Searcher;

use DatabaseBundle\Form\Searcher\SearcherType;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class SearcherController extends Controller
{
    public function searchAction($searcher, Request $request)
    {
        $searcherForm = $this->createForm(SearcherType::class, $searcher);
        $searcherForm->handleRequest($request);
        if ($searcherForm->isSubmitted()) {
            return $this->render('DatabaseBundle:searcher:searchresults.html.twig', array(
                        'searcher' => $searcherForm->createView(),
            ));
        }
    }
}
?>
