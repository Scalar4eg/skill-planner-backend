<?php

namespace App\Repository;

use App\Entity\PlannedTrip;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method PlannedTrip|null find($id, $lockMode = null, $lockVersion = null)
 * @method PlannedTrip|null findOneBy(array $criteria, array $orderBy = null)
 * @method PlannedTrip[]    findAll()
 * @method PlannedTrip[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PlannedTripRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PlannedTrip::class);
    }

    // /**
    //  * @return PlannedTrip[] Returns an array of PlannedTrip objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?PlannedTrip
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
