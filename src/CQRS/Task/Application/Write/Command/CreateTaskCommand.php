<?php
/**
 * Created by PhpStorm.
 * User: Maciej Borzymowski
 * Date: 2020-05-10
 * Time: 12:33
 */

namespace App\CQRS\Task\Application\Write\Command;


use App\CQRS\Stage\Domain\Stage;
use App\Request\Task\TaskRequest;

class CreateTaskCommand
{
    private $stage;
    private $taskRequest;

    public function __construct(Stage $stage, TaskRequest $taskRequest)
    {
        $this->stage = $stage;
        $this->taskRequest = $taskRequest;
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
     * @return TaskRequest
     */
    public function getTaskRequest(): TaskRequest
    {
        return $this->taskRequest;
    }

    /**
     * @param TaskRequest $taskRequest
     */
    public function setTaskRequest(TaskRequest $taskRequest): void
    {
        $this->taskRequest = $taskRequest;
    }
}