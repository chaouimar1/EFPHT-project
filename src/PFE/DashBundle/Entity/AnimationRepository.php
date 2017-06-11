<?php

namespace PFE\DashBundle\Entity;

use Doctrine\ORM\EntityRepository;

class AnimationRepository extends EntityRepository
{

    public function sumPublic(Typeanimation $ta, Bibliotheque $b, $column)
    {
        $qb = $this->createQueryBuilder('a')
            ->select('sum(a.'.$column.')')
            ->leftJoin('a.typeanimation','ta')
            ->leftJoin('a.bibliotheque','b')

            ->where('b=:b')
            ->andWhere('ta=:ta')
            ->setParameter(':ta',$ta)
            ->setParameter(':b',$b)
        ;

        return $qb->getQuery()->getSingleScalarResult();
    }
}
