<?php

namespace PFE\DashBundle\Controller;

use Ob\HighchartsBundle\Highcharts\Highchart;
use PFE\DashBundle\Entity\Bibliotheque;
use PFE\DashBundle\Entity\Province;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class BibController extends Controller
{
    public function presentationAction(Bibliotheque $b)
    {
        $repository = $this->getDoctrine()
            ->getManager()
            ->getRepository('PFEDashBundle:Espace');
        $cplaces = $repository->countplaces($b);
        return $this->render('PFEDashBundle:Bib:presentation.html.twig', array(
            "b" => $b,
            "cplaces" => $cplaces,
        ));
    }

    public function espacesAction(Bibliotheque $b)
    {
        $repository = $this->getDoctrine()
            ->getManager()
            ->getRepository('PFEDashBundle:Espace');

        $espaces = $repository->findByBibliotheque($b);
        $c1 = $repository->counto('isDisponible',1,$b);
        $c2 = $repository->counto('isDisponible',0,$b);
        $c3 = $repository->counto('etat',1,$b);
        $c4 = $repository->counto('etat',0,$b);
        $cplaces = $repository->countplaces($b);

        $chart1 = new Highchart();
        $chart1->chart->renderTo('piechart1');
        $chart1->chart->type('pie'); // Column / Line (default)
        $chart1->title->text('isDispo');
        $chart1->colors('#4CAF50', '#F44336');
        $chart1->plotOptions->pie(array(
            'allowPointSelect'  => true,
            'cursor'    => 'pointer',
            'showInLegend'  => true
        ));
        $data = array(
            array('Disponible', (int)$c1),
            array('Non Disponible', (int)$c2));

        $chart1->series(array(array(
            'name' => 'isDispoooo',
            'data' => $data)));

        $chart2 = new Highchart();
        $chart2->chart->renderTo('piechart2');
        $chart2->chart->type('pie'); // Column / Line (default)
        $chart2->title->text('etat');
        $chart2->colors('#2196F3', '#607d8b');
        $chart2->plotOptions->pie(array(
            'allowPointSelect'  => true,
            'cursor'    => 'pointer',
            //'dataLabels'    => array('enabled' => false),
            'showInLegend'  => true
        ));
        $data = array(
            array('Bon', (int)$c3,'#607d8b'),
            array('Mediocre', (int)$c4,'#607d8b'),
        );
        $chart2->series(array(array(
            'name' => 'etaaaaa',
            'data' => $data,
        )));

        return $this->render('PFEDashBundle:Bib:espaces.html.twig', array(
            "espaces" => $espaces,
            'chart1' => $chart1,
            'chart2' => $chart2,
            'cplaces' => $cplaces,
            'b' => $b,
        ));    }

    public function equipementsAction(Bibliotheque $b)
    {
        return $this->render('PFEDashBundle:Bib:equipements.html.twig', array(
            "b" => $b,

        ));    }

    public function fondsAction(Bibliotheque $b)
    {
        return $this->render('PFEDashBundle:Bib:fonds.html.twig', array(
            "b" => $b,

        ));    }

    public function cataloguesAction(Bibliotheque $b)
    {
        return $this->render('PFEDashBundle:Bib:catalogues.html.twig', array(
            "b" => $b,

        ));    }

    public function pretsAction(Bibliotheque $b)
    {
        return $this->render('PFEDashBundle:Bib:prets.html.twig', array(
            "b" => $b,

        ));    }

    public function animationsAction(Bibliotheque $b)
    {
        return $this->render('PFEDashBundle:Bib:animations.html.twig', array(
            "b" => $b,

        ));    }

    public function remarquesAction(Bibliotheque $b)
    {
        return $this->render('PFEDashBundle:Bib:remarques.html.twig', array(
            "b" => $b,

        ));    }

    public function menuAction()
    {
        $repository = $this->getDoctrine()
            ->getManager()
            ->getRepository('PFEDashBundle:Province');

        $provinces = $repository->findAll();

        return $this->render('PFEDashBundle:Bib:menu.html.twig', array(
            "provinces" => $provinces
        ));
    }

    public function provinceAction(Province $p)
    {
        return $this->render('PFEDashBundle:Bib:province.html.twig', array("p" => $p));
    }

}
