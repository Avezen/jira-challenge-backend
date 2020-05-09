<?php

namespace App\CQRS\TaskStep\Infrastructure;

use App\CQRS\TaskStep\Domain\TaskStep;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method TaskStep|null find($id, $lockMode = null, $lockVersion = null)
 * @method TaskStep|null findOneBy(array $criteria, array $orderBy = null)
 * @method TaskStep[]    findAll()
 * @method TaskStep[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TaskStepRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TaskStep::class);
    }

    // /**
    //  * @return Task[] Returns an array of Task objects
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
    public function findOneBySomeField($value): ?Task
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
