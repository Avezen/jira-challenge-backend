<?php
/**
 * Created by PhpStorm.
 * User: Pc
 * Date: 2019-07-02
 * Time: 09:36
 */

namespace App\Request\Task;

use App\CQRS\Category\Domain\Category;
use App\CQRS\Task\Domain\Task;
use App\CQRS\User\Domain\User;
use Symfony\Component\Validator\Constraints as Assert;

class TaskRequest
{
    /**
     * @Assert\NotBlank()
     * @Assert\Length(min="4", max="100")
     * @var string
     */
    public $name;

    /**
     * @Assert\NotBlank()
     * @var Category
     */
    public $category;

    /**
     * @var TaskStepRequest[]
     * @Assert\Valid()
     */
    public $taskSteps;

    /**
     * @var User
     */
    public $createdFor;

    public static function fromTask(Task $task): self
    {
        $taskRequest = new self();
        $taskRequest->name = $task->getName();
        $taskRequest->category = $task->getCategory();
        $taskRequest->createdFor = $task->getCreatedFor();

        foreach ($task->getTaskSteps() as $taskStep){
            $taskStepRequest = new TaskStepRequest();
            $taskStepRequest->name = $taskStep->getName();

            $taskRequest->taskSteps[] = $taskStepRequest;
        }

        return $taskRequest;
    }
}