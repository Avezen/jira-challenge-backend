<?php
/**
 * Created by PhpStorm.
 * User: Maciej Borzymowski
 * Date: 2020-05-03
 * Time: 13:04
 */

namespace App\CQRS\Column\Application\Read\Handler;


use App\CQRS\Column\Application\Read\Query\ColumnsWithActiveTasksQuery;
use App\CQRS\Column\Application\Read\ColumnInterface;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

class ColumnsWithActiveTasksQueryHandler implements MessageHandlerInterface
{
    private $columnRepository;

    public function __construct(ColumnInterface $columnRepository)
    {
        $this->columnRepository = $columnRepository;
    }

    public function __invoke(ColumnsWithActiveTasksQuery $columnsWithActiveTasksQuery)
    {
        return $this->columnRepository->getColumnsWithActiveTasks();
    }
}