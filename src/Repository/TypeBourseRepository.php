<?php

namespace App\Repository;

use App\Entity\TypeBourse;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method TypeBourse|null find($id, $lockMode = null, $lockVersion = null)
 * @method TypeBourse|null findOneBy(array $criteria, array $orderBy = null)
 * @method TypeBourse[]    findAll()
 * @method TypeBourse[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TypeBourseRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TypeBourse::class);
    }

    // /**
    //  * @return TypeBourse[] Returns an array of TypeBourse objects
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
    public function findOneBySomeField($value): ?TypeBourse
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
