<?php
/**
 * Created by PhpStorm.
 * User: Maciej Borzymowski
 * Date: 2020-05-09
 * Time: 20:52
 */

namespace App\CQRS\Stage\Application\Read\Model\Collection;


use App\CQRS\Stage\Application\Read\Model\Collection\Single\Stage;
use Doctrine\Common\Collections\ArrayCollection;

class StageList
{
    public $stages;

    public function __construct()
    {
        $this->stages = new ArrayCollection();
    }
}