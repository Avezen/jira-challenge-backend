<?php
/**
 * Created by PhpStorm.
 * User: Maciej Borzymowski
 * Date: 2020-05-03
 * Time: 12:54
 */

namespace App\CQRS;


use Symfony\Component\Messenger\Exception\HandlerFailedException;
use Symfony\Component\Messenger\HandleTrait;
use Symfony\Component\Messenger\MessageBusInterface;

class QueryBus
{
    use HandleTrait;

    public function __construct(MessageBusInterface $queryBus)
    {
        $this->messageBus = $queryBus;
    }

    public function query($query)
    {
        try {
            return $this->handle($query);
        } catch (HandlerFailedException $failedException) {
            throw $failedException;
        }
    }
}