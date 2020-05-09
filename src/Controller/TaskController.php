<?php

namespace App\Controller;

use App\CQRS\Task\Application\Read\Query\TaskQuery;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/api")
 */
class TaskController extends ApiController
{
    /**
     * @Route("/", name="api")
     */
    public function api()
    {
        return $this->json(['authorized api!']);
    }

    /**
     * @Route("/task", name="get_task_list")
     */
    public function getTaskList()
    {
        $tasks = $this->queryBus->query(new TaskQuery());

        return $this->json($tasks);
    }
}
