<?php

namespace PFE\DashBundle\Entity;

use Doctrine\ORM\EntityRepository;

class FondocRepository extends EntityRepository
{
    public function findByDate(&$year = null, &$month = null)
    {
        if ($month === null) { $month = (int) date('m'); }
        if ($year === null) { $year = (int) date('Y'); }
        $date = new \DateTime("{$year}-{$month}-01");

        $qb = $this->createQueryBuilder('e');
        $qb->where('e.created BETWEEN :start AND :end')
            ->setParameter('start', $date->format('Y-m-d'))
            ->setParameter('end', $date->format('Y-m-t'))
        ;

        return $qb->getQuery()->getResult();
    }

    public function count($ism, Bibliotheque $b)
    {
        $qb = $this->createQueryBuilder('f')
            ->leftJoin('f.typefondoc','tf')
            ->select('sum(f.nombre)')
            ->leftJoin('f.bibliotheque','b')
            ->where('b=:b')
            ->andWhere('tf.isMultimedia=:ism')
            ->setParameter(':b',$b)
            ->setParameter(':ism',$ism)
            ->orderBy('tf.nom','ASC')
        ;

        return $qb->getQuery()->getSingleScalarResult();
    }

}
