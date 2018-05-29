<?php

namespace App\Repository;

use App\Entity\Monumento;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Monumento|null find($id, $lockMode = null, $lockVersion = null)
 * @method Monumento|null findOneBy(array $criteria, array $orderBy = null)
 * @method Monumento[]    findAll()
 * @method Monumento[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MonumentoRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Monumento::class);
    }

//    /**
//     * @return Monumento[] Returns an array of Monumento objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Monumento
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
