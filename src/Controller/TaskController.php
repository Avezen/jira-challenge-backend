<?php

namespace App\Controller;

use App\CQRS\Task\Application\Read\Query\TasksQuery;
use Symfony\Component\Routing\Annotation\Route;

class TaskController extends ApiController
{
    /**
     * @Route("/api", name="api")
     */
    public function api()
    {
        return $this->json(['authorized api!']);
    }

    /**
     * @Route("/api/task", name="task")
     */
    public function index()
    {
        $tasks = $this->queryBus->query(new TasksQuery());

        return $this->json($tasks);
    }
}
