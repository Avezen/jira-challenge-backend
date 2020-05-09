<?php

namespace App\Controller;

use App\CQRS\Column\Application\Read\Query\ColumnsWithActiveTasksQuery;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/api")
 */
class ColumnController extends ApiController
{
    /**
     * @Route("/column/task/active", name="get_column_with_active_task_list")
     */
    public function getColumnWithActiveTaskList()
    {
        $tasks = $this->queryBus->query(new ColumnsWithActiveTasksQuery());

        return $this->json($tasks);
    }
}
