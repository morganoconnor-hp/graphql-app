<?php

namespace App\Mutation;

use App\Entity\Priority;
use App\Entity\Todo;
use App\Repository\PriorityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Overblog\GraphQLBundle\Definition\Resolver\AliasedInterface;
use Overblog\GraphQLBundle\Definition\Resolver\MutationInterface;

final class TodoMutation implements MutationInterface, AliasedInterface
{
    private $em;
    /**
     * @var PriorityRepository
     */
    private $priorityRepository;

    public function __construct(EntityManagerInterface $em, PriorityRepository $priorityRepository)
    {
        $this->em = $em;
        $this->priorityRepository = $priorityRepository;
    }

    /**
     * @param object $args
     * @return Todo
     */
    public function resolve(object $args): Todo
    {
        dump('$args', $args);

        $priority = $this->priorityRepository
            ->find($args['todo']['priority']);

        dump('$priority', $priority);

        $todo = new Todo();
        $todo->setTitle($args['todo']['title']);
        $todo->setDeadline($args['todo']['deadline']);
        $todo->setDescription($args['todo']['description']);
        $todo->setPriority($priority);

        dump('$todo', $todo);

        $this->em->persist($todo);
        $this->em->flush();

        return $todo;
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