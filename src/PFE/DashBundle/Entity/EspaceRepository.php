<?php

namespace PFE\DashBundle\Entity;

use Doctrine\ORM\EntityRepository;

class EspaceRepository extends EntityRepository
{

    public function counto($column, $value, Bibliotheque $b)
    {
        $qb = $this->createQueryBuilder('e')
            ->select('count(e.id)')
            ->where('e.'.$column.'=:value')
            ->andWhere('e.bibliotheque=:b')
            ->setParameter(':value',$value)
            ->setParameter(':b',$b);

        return $qb->getQuery()->getSingleScalarResult();
    }

    public function countplaces(Bibliotheque $b)
    {
        $qb = $this->createQueryBuilder('e')
            ->select('sum(e.nombrePlaceAssises)')
            ->where('e.bibliotheque=:value')
            ->setParameter(':value',$b)
        ;

        return $qb->getQuery()->getSingleScalarResult();
    }
}
