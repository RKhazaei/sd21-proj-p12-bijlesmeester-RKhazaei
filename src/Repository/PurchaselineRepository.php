<?php

namespace App\Repository;

use App\Entity\Purchaseline;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Purchaseline>
 *
 * @method Purchaseline|null find($id, $lockMode = null, $lockVersion = null)
 * @method Purchaseline|null findOneBy(array $criteria, array $orderBy = null)
 * @method Purchaseline[]    findAll()
 * @method Purchaseline[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PurchaselineRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Purchaseline::class);
    }

//    /**
//     * @return Purchaseline[] Returns an array of Purchaseline objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('p.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Purchaseline
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
