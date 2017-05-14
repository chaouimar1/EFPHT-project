<?php

namespace PFE\DashBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class BibController extends Controller
{
    public function presentationAction()
    {
        return $this->render('PFEDashBundle:Bib:presentation.html.twig', array(
                // ...
            ));    }

    public function espacesAction()
    {
        return $this->render('PFEDashBundle:Bib:espaces.html.twig', array(
                // ...
            ));    }

    public function equipementsAction()
    {
        return $this->render('PFEDashBundle:Bib:equipements.html.twig', array(
                // ...
            ));    }

    public function fondsAction()
    {
        return $this->render('PFEDashBundle:Bib:fonds.html.twig', array(
                // ...
            ));    }

    public function cataloguesAction()
    {
        return $this->render('PFEDashBundle:Bib:catalogues.html.twig', array(
                // ...
            ));    }

    public function pretsAction()
    {
        return $this->render('PFEDashBundle:Bib:prets.html.twig', array(
                // ...
            ));    }

    public function animationsAction()
    {
        return $this->render('PFEDashBundle:Bib:animations.html.twig', array(
                // ...
            ));    }

    public function remarquesAction()
    {
        return $this->render('PFEDashBundle:Bib:remarques.html.twig', array(
                // ...
            ));    }

}
