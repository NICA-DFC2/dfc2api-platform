<?php

namespace App\Repository;

use App\Entity\AffinageLib;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method AffinageLib|null find($id, $lockMode = null, $lockVersion = null)
 * @method AffinageLib|null findOneBy(array $criteria, array $orderBy = null)
 * @method AffinageLib[]    findAll()
 * @method AffinageLib[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AffinageLibRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, AffinageLib::class);
    }

//    /**
//     * @return AffinageLib[] Returns an array of AffinageLib objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?AffinageLib
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
