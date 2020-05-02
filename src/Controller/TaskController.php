<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class TaskController extends AbstractController
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
        return $this->json([
                [
                    "id" => 1,
                    "name" => 'Column one',
                    "description" => '',
                    "tasks" => [
                        [
                            "id" => 6,
                            "name" => 'Task number six tra ta ta ta extender lorem impum ',
                            "description" => 'Task description',
                            "category" => 'BUG',
                            "steps" => [
                                'Task step number one',
                                'Task step number two',
                                'Task step number three',
                            ],
                            "developers" => [1, 2],
                            "createdBy" => 1
                        ]
                    ]
                ],
                [
                    "id" => 2,
                    "name" => 'Column two',
                    "description" => '',
                    "tasks" => [
                        [
                            "id" => 7,
                            "name" => 'Task number six tra ta ta ta extender lorem impum ',
                            "description" => 'Task description',
                            "category" => 'BUG',
                            "steps" => [
                                'Task step number one',
                                'Task step number two',
                                'Task step number three',
                            ],
                            "developers" => [1, 2],
                            "createdBy" => 1
                        ]
                    ]
                ],
                [
                    "id" => 3,
                    "name" => 'Column two',
                    "description" => '',
                    "tasks" => [
                        [
                            "id" => 8,
                            "name" => 'Task number six tra ta ta ta extender lorem impum ',
                            "description" => 'Task description',
                            "category" => 'BUG',
                            "steps" => [
                                'Task step number one',
                                'Task step number two',
                                'Task step number three',
                            ],
                            "developers" => [1, 2],
                            "createdBy" => 1
                        ]
                    ]
                ]
        ]);
    }
}
