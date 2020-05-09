<?php

namespace App\Controller;

use App\CQRS\TaskStep\Application\Read\Query\TaskStepQuery;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/api")
 */
class TaskStepController extends ApiController
{
    /**
     * @Route("/", name="api")
     */
    public function api()
    {
        return $this->json(['authorized api!']);
    }

    /**
     * @Route("/task-step", name="get_task_step_list")
     */
    public function getTaskStepList()
    {
        $tasks = $this->queryBus->query(new TaskStepQuery());

        return $this->json($tasks);
    }
}
