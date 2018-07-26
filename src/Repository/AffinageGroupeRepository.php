<?php

namespace App\Repository;

use App\Entity\AffinageGroupe;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method AffinageGroupe|null find($id, $lockMode = null, $lockVersion = null)
 * @method AffinageGroupe|null findOneBy(array $criteria, array $orderBy = null)
 * @method AffinageGroupe[]    findAll()
 * @method AffinageGroupe[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AffinageGroupeRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, AffinageGroupe::class);
    }

//    /**
//     * @return AffinageGroupe[] Returns an array of AffinageGroupe objects
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
    public function findOneBySomeField($value): ?AffinageGroupe
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
