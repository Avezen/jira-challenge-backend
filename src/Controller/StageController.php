<?php

namespace App\Controller;

use App\CQRS\Category\Domain\Category;
use App\CQRS\Stage\Application\Read\Query\StagesWithActiveTasksQuery;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/api")
 */
class StageController extends ApiController
{
    /**
     * @Route("/stage/task/active", name="get_stage_with_active_task_list")
     */
    public function getStageWithActiveTaskList()
    {
        $tasks = $this->queryBus->query(new StagesWithActiveTasksQuery());

        return $this->json($tasks);
    }
}
