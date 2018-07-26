<?php

namespace App\Repository;

use App\Entity\AffinageValeur;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method AffinageValeur|null find($id, $lockMode = null, $lockVersion = null)
 * @method AffinageValeur|null findOneBy(array $criteria, array $orderBy = null)
 * @method AffinageValeur[]    findAll()
 * @method AffinageValeur[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AffinageValeurRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, AffinageValeur::class);
    }

//    /**
//     * @return AffinageValeur[] Returns an array of AffinageValeur objects
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
    public function findOneBySomeField($value): ?AffinageValeur
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
