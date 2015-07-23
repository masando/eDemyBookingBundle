<?php

namespace eDemy\BookingBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * BookingRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class BookingRepository extends EntityRepository
{
    public function findAll($namespace = null)
    {
        $qb = $this->createQueryBuilder('d');
        //$qb->addSelect('-d.orden as ordenIfNull');
        //$qb->addSelect('ISNULL(d.orden) as HIDDEN ordenIfNull');
        $qb->addSelect('CASE WHEN d.orden IS NULL THEN 9999 ELSE d.orden END as HIDDEN ORD');
        if($namespace == null) {
            $qb->andWhere('d.namespace is null');
        } else {
            $qb->andWhere('d.namespace = :namespace');
            $qb->setParameter('namespace', $namespace);
        }
        //$qb->orderBy('d.created','DESC');
        //$qb->orderBy('ordenIfNull','ASC');
        $qb->orderBy('d.published','DESC');
        $qb->addOrderBy('ORD','ASC');
        $query = $qb->getQuery();

        return $query->getResult();
    }

    public function findLastModified($namespace = null)
    {
        $qb = $this->createQueryBuilder('d');
        if($namespace == null) {
            $qb->andWhere('d.namespace is null');
        } else {
            $qb->andWhere('d.namespace = :namespace');
            $qb->setParameter('namespace', $namespace);
        }
        $qb->orderBy('d.updated','DESC');
        $qb->setMaxResults(1);
        $query = $qb->getQuery();

        return $query->getSingleResult();
    }
}
