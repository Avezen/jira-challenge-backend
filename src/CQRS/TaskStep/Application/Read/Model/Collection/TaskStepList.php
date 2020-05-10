<?php
/**
 * Created by PhpStorm.
 * User: Maciej Borzymowski
 * Date: 2020-05-09
 * Time: 20:56
 */

namespace App\CQRS\TaskStep\Application\Read\Model\Collection;


use App\CQRS\TaskStep\Application\Read\Model\Collection\Single\TaskStep;

class TaskStepList extends \ArrayObject
{
    public function __construct(TaskStep ...$taskSteps)
    {
        parent::__construct($taskSteps);
    }
}