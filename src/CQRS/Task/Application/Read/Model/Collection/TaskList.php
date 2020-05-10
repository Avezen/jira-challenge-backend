<?php
/**
 * Created by PhpStorm.
 * User: Maciej Borzymowski
 * Date: 2020-05-09
 * Time: 20:58
 */

namespace App\CQRS\Task\Application\Read\Model\Collection;


use App\CQRS\Task\Application\Read\Model\Collection\Single\Task;

class TaskList extends \ArrayObject
{
    public function __construct(Task ...$tasks)
    {
        parent::__construct($tasks);
    }
}