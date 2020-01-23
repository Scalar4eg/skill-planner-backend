<?php

namespace App\Repository;

use App\Entity\TripPoint;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method TripPoint|null find($id, $lockMode = null, $lockVersion = null)
 * @method TripPoint|null findOneBy(array $criteria, array $orderBy = null)
 * @method TripPoint[]    findAll()
 * @method TripPoint[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TripPointRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TripPoint::class);
    }

    // /**
    //  * @return TripPoint[] Returns an array of TripPoint objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?TripPoint
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
