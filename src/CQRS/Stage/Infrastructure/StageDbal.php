<?php
/**
 * Created by PhpStorm.
 * User: Maciej Borzymowski
 * Date: 2020-05-03
 * Time: 13:12
 */

namespace App\CQRS\Stage\Infrastructure;


use App\CQRS\Stage\Application\Read\StageInterface;
use App\CQRS\Stage\Domain\Stage;
use Doctrine\ORM\EntityManagerInterface;

class StageDbal implements StageInterface
{
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function getStagesWithActiveTasks()
    {
        $queryBuilder = $this->em->getRepository(Stage::class)->findAll();

        dd($queryBuilder[0]->getTasks()->toArray());

        return $queryBuilder->execute()->fetchAll();
    }

    public function test()
    {
        $queryBuilder = $this->em->getConnection()->createQueryBuilder();

        $queryBuilder->select(
            'col.id as column_id',
            't.id as task_id',
            'cat.id as category_id',
            'ts.id as task_step_id',
            'uby.id as uby_id',
            'ufor.id as ufor_id'
        )
            ->from('`column`', 'col')
            ->join('col', 'task', 't', 'col.id = t.column_id')
            ->join('t', 'category', 'cat', 't.category_id = cat.id')
            ->join('t', 'task_step', 'ts', 'ts.task_id = t.id')
            ->join('t', 'app_users', 'uby', 't.created_by_id = uby.id')
            ->join('t', 'app_users', 'ufor', 't.created_for_id = ufor.id')
            ->groupBy('col.id', 't.id', 'ts.id')
        ;

        dd($queryBuilder->execute()->fetchAll());

        return $queryBuilder->execute()->fetchAll();
    }
}