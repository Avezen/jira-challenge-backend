<?php
/**
 * Created by PhpStorm.
 * User: Maciej Borzymowski
 * Date: 2020-05-03
 * Time: 13:04
 */

namespace App\CQRS\TaskStep\Application\Read\Handler;


use App\CQRS\TaskStep\Application\Read\Query\TaskStepQuery;
use App\CQRS\TaskStep\Application\Read\TaskStepInterface;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

class TaskStepQueryHandler implements MessageHandlerInterface
{
    private $taskStepRepository;

    public function __construct(TaskStepInterface $taskStepRepository)
    {
        $this->taskStepRepository = $taskStepRepository;
    }

    public function __invoke(TaskStepQuery $taskStepQuery)
    {
        return $this->taskStepRepository->getTasks();
    }
}