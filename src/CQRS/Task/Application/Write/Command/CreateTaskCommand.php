<?php
/**
 * Created by PhpStorm.
 * User: Maciej Borzymowski
 * Date: 2020-05-10
 * Time: 12:33
 */

namespace App\CQRS\Task\Application\Write\Command;


use App\Request\Task\TaskRequest;

class CreateTaskCommand
{
    private $columnId;
    private $taskRequest;

    public function __construct(int $columnId, TaskRequest $taskRequest)
    {
        $this->columnId = $columnId;
        $this->taskRequest = $taskRequest;
    }

    /**
     * @return int
     */
    public function getColumnId(): int
    {
        return $this->columnId;
    }

    /**
     * @param int $columnId
     */
    public function setColumnId(int $columnId): void
    {
        $this->columnId = $columnId;
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