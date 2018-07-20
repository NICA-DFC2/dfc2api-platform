<?php

namespace App\Repository;

use App\Entity\ArticleCategorie;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method ArticleCategorie|null find($id, $lockMode = null, $lockVersion = null)
 * @method ArticleCategorie|null findOneBy(array $criteria, array $orderBy = null)
 * @method ArticleCategorie[]    findAll()
 * @method ArticleCategorie[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ArticleCategorieRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, ArticleCategorie::class);
    }

//    /**
//     * @return ArticleCategorie[] Returns an array of ArticleCategorie objects
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
    public function findOneBySomeField($value): ?ArticleCategorie
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
