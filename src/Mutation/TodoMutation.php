<?php

namespace App\Mutation;

use App\Entity\Todo;
use Doctrine\ORM\EntityManagerInterface;
use Overblog\GraphQLBundle\Definition\Argument;
use Overblog\GraphQLBundle\Definition\Resolver\AliasedInterface;
use Overblog\GraphQLBundle\Definition\Resolver\MutationInterface;

final class TodoMutation implements MutationInterface, AliasedInterface
{
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    /**
     * @param Argument $args
     * @return string[]
     */
    public function resolve(Argument $args): array
    {
        $todo = new Todo();
        $todo->setTitle($args['title']);
        $todo->setDeadline($args['deadline']);
        $todo->setDescription($args['description']);

        $this->em->persist($todo);
        $this->em->flush();

        return ['content' => 'ok'];
    }

    /**
     * {@inheritdoc}
     */
    public static function getAliases(): array
    {
        return [
            'resolve' => 'NewTodo'
        ];
    }
}