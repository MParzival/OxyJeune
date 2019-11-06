<?php

namespace App\Repository;

use App\Entity\Leasing;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Leasing|null find($id, $lockMode = null, $lockVersion = null)
 * @method Leasing|null findOneBy(array $criteria, array $orderBy = null)
 * @method Leasing[]    findAll()
 * @method Leasing[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LeasingRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Leasing::class);
    }

    // /**
    //  * @return Leasing[] Returns an array of Leasing objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('l.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Leasing
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
