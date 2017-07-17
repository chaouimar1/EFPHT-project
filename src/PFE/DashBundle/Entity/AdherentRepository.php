<?php

namespace PFE\DashBundle\Entity;

use Doctrine\ORM\EntityRepository;

class AdherentRepository extends EntityRepository
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

    public function counbysexe($sexe, Bibliotheque $b)
    {
        $qb = $this->createQueryBuilder('a')
            ->select('count(a.id)')
            ->leftJoin('a.bibliotheque','b')
            ->where('a.sexe=:sexe')
            ->andWhere('b=:b')

            ->setParameter(':b',$b)
            ->setParameter(':sexe',$sexe)
        ;

        return $qb->getQuery()->getSingleScalarResult();
    }
}
