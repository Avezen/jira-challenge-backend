<?php
/**
 * Created by PhpStorm.
 * User: Maciej Borzymowski
 * Date: 2020-05-03
 * Time: 13:04
 */

namespace App\CQRS\Task\Application\Read\Handler;


use App\CQRS\Task\Application\Read\Query\TasksQuery;
use App\CQRS\Task\Application\Read\TasksInterface;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

class TasksQueryHandler implements MessageHandlerInterface
{
    private $tasksRepository;

    public function __construct(TasksInterface $tasksRepository)
    {
        $this->tasksRepository = $tasksRepository;
    }

    public function __invoke(TasksQuery $tasksQuery)
    {
        return $this->tasksRepository->getTasks();
    }
}