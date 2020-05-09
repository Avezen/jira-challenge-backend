<?php
/**
 * Created by PhpStorm.
 * User: Maciej Borzymowski
 * Date: 2020-05-03
 * Time: 13:04
 */

namespace App\CQRS\Category\Application\Read\Handler;


use App\CQRS\Category\Application\Read\Query\CategoryQuery;
use App\CQRS\Category\Application\Read\CategoryInterface;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

class CategoryQueryHandler implements MessageHandlerInterface
{
    private $categoryRepository;

    public function __construct(CategoryInterface $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function __invoke(CategoryQuery $tasksQuery)
    {
        return $this->categoryRepository->getTasks();
    }
}