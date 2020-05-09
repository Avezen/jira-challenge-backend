<?php
/**
 * Created by PhpStorm.
 * User: Maciej Borzymowski
 * Date: 2020-05-03
 * Time: 13:04
 */

namespace App\CQRS\User\Application\Read\Handler;


use App\CQRS\User\Application\Read\Query\UserQuery;
use App\CQRS\User\Application\Read\UserInterface;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

class UserQueryHandler implements MessageHandlerInterface
{
    private $userRepository;

    public function __construct(UserInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function __invoke(UserQuery $tasksQuery)
    {
        return $this->userRepository->getTasks();
    }
}