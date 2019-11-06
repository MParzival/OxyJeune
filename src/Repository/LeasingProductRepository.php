<?php

namespace App\Repository;

use App\Entity\LeasingProduct;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method LeasingProduct|null find($id, $lockMode = null, $lockVersion = null)
 * @method LeasingProduct|null findOneBy(array $criteria, array $orderBy = null)
 * @method LeasingProduct[]    findAll()
 * @method LeasingProduct[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LeasingProductRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, LeasingProduct::class);
    }

    // /**
    //  * @return LeasingProduct[] Returns an array of LeasingProduct objects
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
    public function findOneBySomeField($value): ?LeasingProduct
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
