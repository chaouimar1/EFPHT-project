<?php

namespace PFE\DashBundle\Entity;

use Doctrine\ORM\EntityRepository;

class EquipementRepository extends EntityRepository
{

    public function getEquipementsByBibliotheque($ray, Bibliotheque $b)
    {
        $qb = $this->createQueryBuilder('eq')
            ->leftJoin('eq.espace','e')
            ->leftJoin('eq.typeequipement','teq')
            ->addSelect('teq')
            ->leftJoin('e.bibliotheque','b')
            ->where('b=:b')
            ->andWhere('teq.isRayonnage=:ray')
            ->setParameter(':b',$b)
            ->setParameter(':ray',$ray)
            ->orderBy('teq.nom','ASC')
        ;

        return $qb->getQuery()->getArrayResult();
    }

    public function countetat($ray, $dispo, Bibliotheque $b)
    {
        $qb = $this->createQueryBuilder('eq')
            ->select('count(eq.id)')
            ->leftJoin('eq.espace','e')
            ->leftJoin('eq.typeequipement','teq')
            ->leftJoin('e.bibliotheque','b')
            ->where('b=:b')
            ->andWhere('eq.isDisponible=:dispo')
            ->andWhere('teq.isRayonnage=:ray')
            ->setParameter(':dispo',$dispo)
            ->setParameter(':ray',$ray)
            ->setParameter(':b',$b)
        ;

        return $qb->getQuery()->getSingleScalarResult();
    }
}
