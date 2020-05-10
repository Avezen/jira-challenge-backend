<?php
/**
 * Created by PhpStorm.
 * User: Maciej Borzymowski
 * Date: 2020-05-09
 * Time: 20:55
 */

namespace App\CQRS\Category\Application\Read\Model\Collection;


use App\CQRS\Category\Application\Read\Model\Collection\Single\Category;

class CategoryList extends \ArrayObject
{
    public function __construct(Category ...$categories)
    {
        parent::__construct($categories);
    }
}