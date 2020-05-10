<?php
/**
 * Created by PhpStorm.
 * User: Pc
 * Date: 2019-07-01
 * Time: 14:31
 */

namespace App\Form\Task;


use App\CQRS\User\Domain\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;

class IdToUserTransformer implements DataTransformerInterface
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function transform($user)
    {
        if ($user == null) {
            return '';
        }

        return $user->getId();
    }

    public function reverseTransform($id)
    {
        dd($id);

        if (!$id) {
            return;
        }

        $user = $this->entityManager->getRepository(User::class)->findOneBy(
            [
                'id' => $id
            ]
        );

        if (null === $user) {
            // causes a validation error
            // this message is not shown to the user
            // see the invalid_message option
            throw new TransformationFailedException(sprintf(
                'A company with id "%s" does not exist!',
                $id
            ));
        }
        return $user;
    }
}