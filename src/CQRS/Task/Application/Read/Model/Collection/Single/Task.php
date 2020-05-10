<?php
/**
 * Created by PhpStorm.
 * User: Maciej Borzymowski
 * Date: 2020-05-09
 * Time: 20:57
 */

namespace App\CQRS\Task\Application\Read\Model\Collection\Single;


class Task
{
    public $id;
    public $name;
    public $category;
    public $taskSteps;
    public $createdBy;
    public $createdFor;
}