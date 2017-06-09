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
        $repository = $this->getDoctrine()
            ->getManager()
            ->getRepository('PFEDashBundle:Equipement');

        $equipements = $repository->getEquipementsByBibliotheque(0,$b);
        $rayonnages = $repository->getEquipementsByBibliotheque(1,$b);
        $c_equ_ndispo = $repository->countetat(0,0,$b);
        $c_equ_dispo = $repository->countetat(0,1,$b);
        $c_ray_ndispo = $repository->countetat(1,0,$b);
        $c_ray_dispo = $repository->countetat(1,1,$b);

        $qb1 = $this->getDoctrine()->getManager();
        $qb1 = $qb1->createQueryBuilder();
        $qb1->select('teq.nom')
            ->from('PFEDashBundle:Typeequipement', 'teq')
            ->where('teq.isRayonnage=:ray')
            ->setParameter(':ray',0)
            ->orderBy('teq.nom','ASC');
        $teq_e = $qb1->getQuery()->getArrayResult();

        $cats_e = array();
        foreach ($teq_e as $item) {
            $cats_e[]=$item['nom'];
        }

        $countcats_e = array();
        foreach ($equipements as $e) {
            $countcats_e['nombre'][] = $e['nombre'];
            $countcats_e['nombre_endommage'][] = $e['nombre_endommage'];
            $countcats_e['nombre_nutilisable'][] = $e['nombre_nutilisable'];
        }

        $qb2 = $this->getDoctrine()->getManager();
        $qb2 = $qb2->createQueryBuilder();
        $qb2->select('teq.nom')
            ->from('PFEDashBundle:Typeequipement', 'teq')
            ->where('teq.isRayonnage=:ray')
            ->setParameter(':ray',1)
            ->orderBy('teq.nom','ASC');
        $teq_r = $qb2->getQuery()->getArrayResult();

        $cats_r = array();
        foreach ($teq_r as $item) {
            $cats_r[]=$item['nom'];
        }

        $countcats_r = array();
        foreach ($rayonnages as $r) {
            $countcats_r['nombre'][] = $r['nombre'];
            $countcats_r['nombre_endommage'][] = $r['nombre_endommage'];
            $countcats_r['nombre_nutilisable'][] = $r['nombre_nutilisable'];
        }

        $chart1 = new Highchart();
        $chart1->chart->renderTo('piechart1');
        $chart1->chart->type('pie'); // Column / Line (default)
        $chart1->title->text('Disponibilités des équipements');
        $chart1->colors('#4CAF50', '#F44336');
        $chart1->plotOptions->pie(array(
            'allowPointSelect'  => true,
            'cursor'    => 'pointer',
            'dataLabels'    => array('enabled' => false),
            'showInLegend'  => true
        ));
        $data = array(
            array('Disponible', (int)$c_equ_dispo),
            array('Non Disponible', (int)$c_equ_ndispo));

        $chart1->series(array(array(
            'name' => 'isDispoooo',
            'data' => $data)));

        $chart3 = new Highchart();
        $chart3->chart->renderTo('barchart1');  // The #id of the div where to render the chart
        $chart3->chart->type('column'); // bar / area / Column / Line (default)
        $chart3->title->text('Historic World Population by Region');


        $chart3->xAxis->categories($cats_e);

        $chart3->colors('#2196F3', '#ff9800', '#616161');

        $chart3->plotOptions->tooltip(array('valueSuffix'=>'millions'));
        $chart3->plotOptions->series(array(
//            'stacking'=> 'normal',
            'dataLabels'=>array('enabled'=>true),
        ));

        $chart3->yAxis->title(array('text'  => " ", 'align' => 'high'));
        $s = array(array(
            'name' => 'Nombre',
            'data' => $countcats_e['nombre'],
        ),array(
            'name' => 'endom',
            'data' => $countcats_e['nombre_endommage'],
        ),array(
            'name' => 'non util',
            'data' => $countcats_e['nombre_nutilisable'],
        ));
        $chart3->series($s);


        $chart2 = new Highchart();
        $chart2->chart->renderTo('piechart2');
        $chart2->chart->type('pie'); // Column / Line (default)
        $chart2->title->text('Disponibilités des équipements');
        $chart2->colors('#4CAF50', '#F44336');
        $chart2->plotOptions->pie(array(
            'allowPointSelect'  => true,
            'cursor'    => 'pointer',
            'dataLabels'    => array('enabled' => false),
            'showInLegend'  => true
        ));
        $data = array(
            array('Disponible', (int)$c_ray_dispo),
            array('Non Disponible', (int)$c_ray_ndispo));

        $chart2->series(array(array(
            'name' => 'isDispoooo',
            'data' => $data)));

        $chart4 = new Highchart();
        $chart4->chart->renderTo('barchart2');  // The #id of the div where to render the chart
        $chart4->chart->type('column'); // bar / area / Column / Line (default)
        $chart4->title->text('Historic World Population by Region');


        $chart4->xAxis->categories($cats_r);

        $chart4->colors('#2196F3', '#ff9800', '#616161');

        $chart4->plotOptions->tooltip(array('valueSuffix'=>'millions'));
        $chart4->plotOptions->series(array(
//            'stacking'=> 'normal',
            'dataLabels'=>array('enabled'=>true),
        ));

        $chart4->yAxis->title(array('text'  => " ", 'align' => 'high'));
        $s = array(array(
            'name' => 'Nombre',
            'data' => $countcats_r['nombre'],
        ),array(
            'name' => 'endom',
            'data' => $countcats_r['nombre_endommage'],
        ),array(
            'name' => 'non util',
            'data' => $countcats_r['nombre_nutilisable'],
        ));
        $chart4->series($s);

        return $this->render('PFEDashBundle:Bib:equipements.html.twig', array(
            "b" => $b,
            "equipements" => $equipements,
            "rayonnages" => $rayonnages,
            "chart1" => $chart1,
            "chart2" => $chart2,
            "chart3" => $chart3,
            "chart4" => $chart4,
        ));    }

    public function fondsAction(Bibliotheque $b)
    {
        $repository = $this->getDoctrine()
            ->getManager()
            ->getRepository('PFEDashBundle:Fondoc');

        $fondocs = $repository->findByBibliotheque($b);
        $c1 = $repository->count(0,$b);
        $c2 = $repository->count(1,$b);
        $count = $c1+$c2;

        /////////////////////////////////////////////////

        $chart1 = new Highchart();
        $chart1->chart->renderTo('piechart');
        $chart1->chart->type('pie'); // Column / Line (default)
        $chart1->title->text('Fonds documentaires');
        $chart1->colors('#26a69a', '#ec407a', '#5c6bc0', '#29b6f6', '#ef5350');
        $chart1->plotOptions->pie(array(
            'allowPointSelect'  => true,
            'cursor'    => 'pointer',
            'dataLabels'    => array('enabled' => false),
            'showInLegend'  => true
        ));
        $data = array();
        foreach ($fondocs as $fondoc) {
            $data[] = array($fondoc->getTypefondoc()->getNom(),$fondoc->getNombre());
        }

        $chart1->series(array(array(
            'name' => 'Nombre',
            'data' => $data)));

        //****************  Line chart  ****************//
        $series = array(
            array("name" => "Data Serie Name",    "data" => array(1,2,4,5,6,3,8,1,2,4,5,6,3,8,1,2,4,5,6,3,8)),
            array("name" => "Data Serie Name",    "data" => array(2,4,6,8,10,13,18,2,4,6,8,10,13,18,2,4,6,8,10,13,18)),
            array("name" => "Data Serie Name",    "data" => array(21,32,44,55,66,73,2,4,6,8,10,13,18,2,4,6,21,32,44,55,6)),
            array("name" => "Data Serie Name",    "data" => array(21,32,44,55,66,73,88,21,32,44,55,66,73,88,21,32,4,5,6,3,8))
        );

        $chart3 = new Highchart();
        $chart3->chart->renderTo('linechart');  // The #id of the div where to render the chart
        $chart3->chart->type('line'); // Column / Line (default)
        $chart3->title->text('Chart COLUMN/LINE Title');
        $chart3->xAxis->title(array('text'  => "Horizontal axis title"));
        $chart3->plotOptions->series(array( 'pointStart' => 3));
        $chart3->yAxis->title(array('text'  => "Vertical axis title"));
        $chart3->series($series);

        return $this->render('PFEDashBundle:Bib:fonds.html.twig', array(
            "b" => $b,
            "fondocs" => $fondocs,
            "count"  => $count,
            "chart1" => $chart1,
            "chart3" => $chart3,
            "colors" => $chart1->colors
        ));    }

    public function cataloguesAction(Bibliotheque $b)
    {
        return $this->render('PFEDashBundle:Bib:catalogues.html.twig', array(
            "b" => $b,

        ));    }

    public function pretsAction(Bibliotheque $b)
    {

        $repository = $this->getDoctrine()
            ->getManager()
            ->getRepository('PFEDashBundle:Pret');

        $prets = $repository->getPretByBibliotheque($b);
        $countdocs = $repository->countdocs($b);
        $countdocs_interne = $repository->countdocs($b,'interne');
        $countdocs_externe = $repository->countdocs($b,'externe');

        $countprets = $repository->countdocs($b,'','pret');
        $countprets_interne  = $repository->countdocs($b,'interne','pret');
        $countprets_externe  = $repository->countdocs($b,'externe','pret');

//        $chart1 = new Highchart();
//        $chart1->chart->renderTo('piechart1');
//        $chart1->chart->type('pie'); // Column / Line (default)
//        $chart1->title->text('Count Docs');
//        $chart1->colors('#5c6bc0', '#42A5F5');
//        $chart1->plotOptions->pie(array(
//            'allowPointSelect'  => true,
//            'cursor'    => 'pointer',
//            'dataLabels'    => array('enabled' => false),
//            'showInLegend'  => true
//        ));
//        $data = array(
//            array('docs pretés interne', (int)$countdocs_interne),
//            array('docs pretés externe', (int)$countdocs_externe));
//
//        $chart1->series(array(array(
//            'name' => 'type de pret',
//            'data' => $data)));
//
//        $chart2 = new Highchart();
//        $chart2->chart->renderTo('piechart2');
//        $chart2->chart->type('pie'); // Column / Line (default)
//        $chart2->title->text('Count Prets');
//        $chart2->colors('#5c6bc0', '#42A5F5');
//        $chart2->plotOptions->pie(array(
//            'allowPointSelect'  => true,
//            'cursor'    => 'pointer',
//            'dataLabels'    => array('enabled' => false),
//            'showInLegend'  => true
//        ));
//        $data = array(
//            array('prets interne', (int)$countprets_interne),
//            array('prets externe', (int)$countprets_externe),
//        );
//        $chart2->series(array(array(
//            'name' => 'nombre de prets',
//            'data' => $data,
//        )));

        return $this->render('PFEDashBundle:Bib:prets.html.twig', array(
            "b" => $b,
            "prets" => $prets,
            "countdocs" => $countdocs,
            "countprets" => $countprets,
//            "chart1" => $chart1,
//            "chart2" => $chart2,
            "countdocs_interne" => $countdocs_interne,
            "countdocs_externe" => $countdocs_externe,
            "countprets_interne" => $countprets_interne,
            "countprets_externe" => $countprets_externe,
        ));    }

    public function animationsAction(Bibliotheque $b)
    {
        return $this->render('PFEDashBundle:Bib:animations.html.twig', array(
            "b" => $b,

        ));    }

    public function remarquesAction(Bibliotheque $b)
    {
        $repository = $this->getDoctrine()
            ->getManager()
            ->getRepository('PFEDashBundle:Remarque');

        $remarques = $repository->findBy(array('bibliotheque' => $b,'type'=>'remarque'));
        $besoins = $repository->findBy(array('bibliotheque' => $b,'type'=>'besoin'));
        return $this->render('PFEDashBundle:Bib:remarques.html.twig', array(
            "b" => $b,
            "remarques" => $remarques,
            "besoins" => $besoins,
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
