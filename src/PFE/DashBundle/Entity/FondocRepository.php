<?php

namespace PFE\DashBundle\Entity;

use Doctrine\ORM\EntityRepository;

class FondocRepository extends EntityRepository
{
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
