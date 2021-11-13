<?php

namespace App\Repository;

use App\Entity\TypeConsommable;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method TypeConsommable|null find($id, $lockMode = null, $lockVersion = null)
 * @method TypeConsommable|null findOneBy(array $criteria, array $orderBy = null)
 * @method TypeConsommable[]    findAll()
 * @method TypeConsommable[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TypeConsommableRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TypeConsommable::class);
    }

    // /**
    //  * @return TypeConsommable[] Returns an array of TypeConsommable objects
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
    public function findOneBySomeField($value): ?TypeConsommable
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
