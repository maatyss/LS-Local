<?php

namespace App\Repository;

use App\Entity\MarkerType;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<MarkerType>
 */
class MarkerTypeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MarkerType::class);
    }

        /**
         * @return MarkerType[] Returns an array of MarkerType objects
         */
        public function getAll(): array
        {
            return $this->createQueryBuilder('m')
                ->getQuery()
                ->getResult()
            ;
        }

    //    public function findOneBySomeField($value): ?MarkerType
    //    {
    //        return $this->createQueryBuilder('m')
    //            ->andWhere('m.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
