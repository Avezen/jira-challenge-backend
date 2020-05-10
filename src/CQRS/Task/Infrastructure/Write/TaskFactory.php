<?php
/**
 * Created by PhpStorm.
 * User: Maciej Borzymowski
 * Date: 2020-05-10
 * Time: 12:58
 */

namespace App\CQRS\Task\Infrastructure\Write;


use App\CQRS\Stage\Domain\Stage;
use App\CQRS\Task\Domain\Task;
use App\CQRS\TaskStep\Domain\TaskStep;
use App\Request\Task\TaskRequest;
use Doctrine\ORM\EntityManagerInterface;

class TaskFactory
{
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function create(int $columnId, TaskRequest $taskRequest)
    {
        //ToDo remove get stage from here, place it in handler or even form
        $stage = $this->em->getRepository(Stage::class)->find($columnId);

        $task = new Task();
        $task
            ->setStage($stage)
            ->setName($taskRequest->name)
            ->setCategory($taskRequest->category)
            ->setCreatedFor($taskRequest->createdFor)
            ->setCreatedBy($taskRequest->createdFor)
            ;

        foreach ($taskRequest->taskSteps as $taskStepRequest) {
            $taskStep = new TaskStep();
            $taskStep
                ->setName($taskStepRequest->name)
                ->setTask($task)
            ;

            $this->em->persist($taskStep);
        }

        $this->em->persist($task);
        $this->em->flush();
    }
}