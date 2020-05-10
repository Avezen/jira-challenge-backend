<?php
/**
 * Created by PhpStorm.
 * User: Maciej Borzymowski
 * Date: 2020-05-10
 * Time: 12:36
 */

namespace App\CQRS\Task\Application\Write\Handler;


use App\CQRS\Task\Application\Write\Command\CreateTaskCommand;
use App\CQRS\Task\Application\Write\Command\UpdateTaskStageCommand;
use App\CQRS\Task\Infrastructure\Write\TaskFactory;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

class UpdateTaskStageCommandHandler implements MessageHandlerInterface
{
    private $taskFactory;

    public function __construct(TaskFactory $taskFactory)
    {
        $this->taskFactory = $taskFactory;
    }

    public function __invoke(UpdateTaskStageCommand $updateTaskStageCommand)
    {
        $this->taskFactory->updateStage(
            $updateTaskStageCommand->getStage(),
            $updateTaskStageCommand->getTask()
        );
    }
}