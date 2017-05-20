<?php

namespace PFE\DashBundle\Controller;

use PFE\DashBundle\Entity\Bibliotheque;
use PFE\DashBundle\Entity\Province;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class BibController extends Controller
{
    public function presentationAction(/*Bibliotheque $bibliotheque*/)
    {
        return $this->render('PFEDashBundle:Bib:presentation.html.twig', array(
            //"bibliotheque" => $bibliotheque,
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

    public function menuAction()
    {

        // On récupère le repository
        $repository = $this->getDoctrine()
            ->getManager()
            ->getRepository('PFEDashBundle:Province')
        ;

        // On récupère l'entité correspondante à l'id $id
        $provinces = $repository->findAll();

        return $this->render('PFEDashBundle:Bib:menu.html.twig', array(
            "provinces" => $provinces
        ));    }

    public function provinceAction(Province $province ,Request $request)
    {
        $request->getSession()->getFlashBag()->add('info', 'getting all provinces.');

        return $this->render('PFEDashBundle:Bib:province.html.twig', array(
            "province" => $province,
        ));    }

}
