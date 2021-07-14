<?php

namespace App\Repository;

use App\Entity\WeatherCheckpoint;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method WeatherCheckpoint|null find($id, $lockMode = null, $lockVersion = null)
 * @method WeatherCheckpoint|null findOneBy(array $criteria, array $orderBy = null)
 * @method WeatherCheckpoint[]    findAll()
 * @method WeatherCheckpoint[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class WeatherCheckpointRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, WeatherCheckpoint::class);
    }
//
//    public function paginate($dql, $page = 1, $limit = 100)
//    {
//        $paginator = new Paginator($dql);
//
//        $paginator->getQuery()
//            ->setFirstResult($limit * ($page - 1))
//            ->setMaxResults($limit);
//
//        return $paginator;
//    }
//
//    public function getAllPoints($currentPage = 1)
//    {
//        // Create our query
//        $query = $this->createQueryBuilder('p')
//            ->orderBy('p.created', 'DESC')
//            ->getQuery();
//
//
//        $paginator = $this->paginate($query, $currentPage);
//
//        return $paginator;
//    }
    // /**
    //  * @return WeatherCheckpoint[] Returns an array of WeatherCheckpoint objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('w')
            ->andWhere('w.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('w.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */


    /*
    public function findOneBySomeField($value): ?WeatherCheckpoint
    {
        return $this->createQueryBuilder('w')
            ->andWhere('w.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
