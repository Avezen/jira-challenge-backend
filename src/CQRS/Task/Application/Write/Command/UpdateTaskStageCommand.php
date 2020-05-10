<?php
/**
 * Created by PhpStorm.
 * User: Maciej Borzymowski
 * Date: 2020-05-10
 * Time: 12:33
 */

namespace App\CQRS\Task\Application\Write\Command;


use App\CQRS\Stage\Domain\Stage;
use App\CQRS\Task\Domain\Task;

class UpdateTaskStageCommand
{
    private $stage;
    private $task;

    public function __construct(Stage $stage, Task $task)
    {
        $this->stage = $stage;
        $this->task = $task;
    }

    /**
     * @return Stage
     */
    public function getStage(): Stage
    {
        return $this->stage;
    }

    /**
     * @param Stage $stage
     */
    public function setStage(Stage $stage): void
    {
        $this->stage = $stage;
    }

    /**
     * @return Task
     */
    public function getTask(): Task
    {
        return $this->task;
    }

    /**
     * @param Task $task
     */
    public function setTaskRequest(Task $task): void
    {
        $this->task = $task;
    }
}