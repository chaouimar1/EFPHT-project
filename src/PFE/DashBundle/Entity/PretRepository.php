<?php

namespace PFE\DashBundle\Entity;

use Doctrine\ORM\EntityRepository;

class PretRepository extends EntityRepository
{

    public function getPretByBibliotheque(Bibliotheque $b)
    {
        $qb = $this->createQueryBuilder('p')
            ->leftJoin('p.fondoc','f')
            ->leftJoin('p.typepret','tp')
            ->leftJoin('f.bibliotheque','b')
            ->leftJoin('f.typefondoc','tf')
            ->addSelect('p')
            ->addSelect('f')
            ->addSelect('tf')
            ->addSelect('tp')
            ->where('b=:b')
            ->setParameter(':b',$b)
            ->orderBy('tf.nom','ASC')
        ;

        return $qb->getQuery()->getArrayResult();
    }

    public function countdocs(Bibliotheque $b, $type='',$select='')
    {
        $qb = $this->createQueryBuilder('p')
            ->leftJoin('p.fondoc','f')
            ->leftJoin('f.bibliotheque','b')
            ->where('b=:value')
            ->setParameter(':value',$b)
        ;

        if($type!=''){
            $qb->leftJoin('p.typepret','tp')
                ->andWhere('tp.nom=:type')
                ->setParameter(':type',$type); }

        if($select=='pret') { $qb->select('count(p.id)');   }
        else                { $qb->select('sum(p.nombre)'); }

        return $qb->getQuery()->getSingleScalarResult();
    }

    public function dkfjs(Bibliotheque $b, $type='')
    {
//        count doc
//        count pret
//        ==> group by fondoc
        // yes 3awtani pie
    }
}
