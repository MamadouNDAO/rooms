<?php

namespace App\Repository;

use App\Entity\EtudiantSearch;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method EtudiantSearch|null find($id, $lockMode = null, $lockVersion = null)
 * @method EtudiantSearch|null findOneBy(array $criteria, array $orderBy = null)
 * @method EtudiantSearch[]    findAll()
 * @method EtudiantSearch[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EtudiantSearchRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, EtudiantSearch::class);
    }

    // /**
    //  * @return EtudiantSearch[] Returns an array of EtudiantSearch objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?EtudiantSearch
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
