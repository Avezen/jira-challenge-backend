<?php
/**
 * Created by PhpStorm.
 * User: Pc
 * Date: 2019-07-01
 * Time: 14:31
 */

namespace App\Form\Task;


use App\CQRS\Category\Domain\Category;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;

class IdToCategoryTransformer implements DataTransformerInterface
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function transform($category)
    {
        if ($category == null) {
            return '';
        }

        return $category->getId();
    }

    public function reverseTransform($id)
    {
        if (!$id) {
            return;
        }

        $category = $this->entityManager->getRepository(Category::class)->findOneBy(
            [
                'id' => $id
            ]
        );

        if (null === $category) {
            // causes a validation error
            // this message is not shown to the user
            // see the invalid_message option
            throw new TransformationFailedException(sprintf(
                'A company with id "%s" does not exist!',
                $id
            ));
        }
        return $category;
    }
}