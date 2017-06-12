<?php

namespace PFE\DashBundle\Entity;

use Doctrine\ORM\EntityRepository;

class AdherentRepository extends EntityRepository
{

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
