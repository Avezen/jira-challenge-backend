<?php
/**
 * Created by PhpStorm.
 * User: Maciej Borzymowski
 * Date: 2020-05-03
 * Time: 13:04
 */

namespace App\CQRS\Task\Application\Read\Handler;


use App\CQRS\Task\Application\Read\Query\TaskQuery;
use App\CQRS\Task\Application\Read\TaskInterface;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

class TaskQueryHandler implements MessageHandlerInterface
{
    private $taskRepository;

    public function __construct(TaskInterface $taskRepository)
    {
        $this->taskRepository = $taskRepository;
    }

    public function __invoke(TaskQuery $taskQuery)
    {
        return $this->taskRepository->getTasks();
    }
}