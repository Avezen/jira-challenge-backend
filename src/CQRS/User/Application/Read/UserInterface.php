<?php
/**
 * Created by PhpStorm.
 * User: Maciej Borzymowski
 * Date: 2020-05-03
 * Time: 13:06
 */

namespace App\CQRS\User\Application\Read;


interface UserInterface
{
    public function getTasks();
}