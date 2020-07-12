<?php

namespace App\Repository;

use App\Entity\Etudiant;
use App\Entity\EtudiantSearch;
use App\Form\EtudiantSearchType;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Etudiant|null find($id, $lockMode = null, $lockVersion = null)
 * @method Etudiant|null findOneBy(array $criteria, array $orderBy = null)
 * @method Etudiant[]    findAll()
 * @method Etudiant[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EtudiantRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Etudiant::class);
    }

     /**
      * @return Query
      */

    public function findAllVisibleQuery(EtudiantSearch $search): Query
    {



        $query = $this->createQueryBuilder('e')
            ->andWhere('e.status = :val')
            ->setParameter('val', 'actif');

            if($search->getPrenom())
            {
                $query= $query
                    ->andWhere('e.prenom= :prenom')
                    ->setParameter('prenom', $search->getPrenom());
            }
            if($search->getNom())
            {
                $query= $query
                    ->andWhere('e.nom= :nom')
                    ->setParameter('nom', $search->getNom());
            }
            if($search->getDepartement())
            {
                $query= $query
                    ->andWhere('e.departement = :depart')
                    ->setParameter('depart',$search->getDepartement());
            }
            if($search->getTypeEtudiant())
            {
                $query= $query
                    ->andWhere('e.type_etudiant= :type')
                    ->setParameter('type', $search->getTypeEtudiant());
            }

            return $query->getQuery();
            //$query->getResult();

    }


    /*
    public function findOneBySomeField($value): ?Etudiant
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
