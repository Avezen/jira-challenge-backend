<?php

namespace App\Controller;

use App\CQRS\Category\Application\Read\Query\CategoryQuery;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/api")
 */
class CategoryController extends ApiController
{
    /**
     * @Route("/", name="api")
     */
    public function api()
    {
        return $this->json(['authorized api!']);
    }

    /**
     * @Route("/category", name="get_category_list")
     */
    public function getCategoryList()
    {
        $tasks = $this->queryBus->query(new CategoryQuery());

        return $this->json($tasks);
    }
}
