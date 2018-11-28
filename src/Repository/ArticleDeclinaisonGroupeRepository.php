<?php

namespace App\Repository;

use App\Entity\ArticleDeclinaisonGroupe;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method ArticleDeclinaisonGroupe|null find($id, $lockMode = null, $lockVersion = null)
 * @method ArticleDeclinaisonGroupe|null findOneBy(array $criteria, array $orderBy = null)
 * @method ArticleDeclinaisonGroupe[]    findAll()
 * @method ArticleDeclinaisonGroupe[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ArticleDeclinaisonGroupeRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, ArticleDeclinaisonGroupe::class);
    }

//    /**
//     * @return ArticleDeclinaisonGroupe[] Returns an array of ArticleDeclinaisonGroupe objects
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
    public function findOneBySomeField($value): ?ArticleDeclinaisonGroupe
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
