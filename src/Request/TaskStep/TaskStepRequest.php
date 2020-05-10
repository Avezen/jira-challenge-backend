<?php
/**
 * Created by PhpStorm.
 * User: Pc
 * Date: 2019-07-02
 * Time: 09:36
 */

namespace App\Request\Task;

use App\CQRS\TaskStep\Domain\TaskStep;
use Symfony\Component\Validator\Constraints as Assert;

class TaskStepRequest
{
    /**
     * @Assert\NotBlank()
     * @Assert\Length(min="4", max="100")
     * @var string
     */
    public $name;

    public static function fromTaskStep(TaskStep $taskStep): self
    {
        $taskStepRequest = new self();
        $taskStepRequest->name = $taskStep->getName();

        return $taskStepRequest;
    }
}