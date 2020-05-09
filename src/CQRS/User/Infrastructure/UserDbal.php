<?php
/**
 * Created by PhpStorm.
 * User: Maciej Borzymowski
 * Date: 2020-05-03
 * Time: 13:12
 */

namespace App\CQRS\User\Infrastructure;


use App\CQRS\User\Application\Read\UserInterface;
use App\CQRS\User\Domain\User;
use Doctrine\ORM\EntityManagerInterface;

class UserDbal implements UserInterface
{
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function getTasks()
    {
        $qb = $this->em->getRepository(User::class);

//        dd($qb->findAll());
//        $qb->select('*')
//            ->from('tasks')
//        ;
//
//        $tasks = $qb->execute()->fetchAll();

        return [
            [
                "id" => 10,
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
                "id" => 20,
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
                "id" => 30,
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
        ];
    }
}