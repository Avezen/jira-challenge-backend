<?php

namespace App\CQRS\Stage\Infrastructure;

use App\CQRS\Stage\Domain\Stage;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query\Expr\Join;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Stage|null find($id, $lockMode = null, $lockVersion = null)
 * @method Stage|null findOneBy(array $criteria, array $orderBy = null)
 * @method Stage[]    findAll()
 * @method Stage[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class StageRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Stage::class);
    }

    public function getStagesWithActiveTasks()
    {
        return $this->createQueryBuilder('s')
            ->join('s.tasks', 't', 's.id = t.stage_id')
            ->join('t.category', 'cat')
            ->join('t.taskSteps', 'ts')
            ->join('t.createdBy', 'uby')
            ->join('t.createdFor', 'ufor')
            ->orderBy('t.id', 'ASC')
            ->getQuery()
            ->execute()
        ;
    }

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
