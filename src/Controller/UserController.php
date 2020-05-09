<?php

namespace App\Controller;

use App\CQRS\User\Application\Read\Query\UserQuery;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/api")
 */
class UserController extends ApiController
{
    /**
     * @Route("/", name="api")
     */
    public function api()
    {
        return $this->json(['authorized api!']);
    }

    /**
     * @Route("/task-step", name="get_user_list")
     */
    public function getUserList()
    {
        $tasks = $this->queryBus->query(new UserQuery());

        return $this->json($tasks);
    }
}
