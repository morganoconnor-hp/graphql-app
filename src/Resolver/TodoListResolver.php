<?php

namespace App\Resolver;

use App\Entity\Priority;
use App\Entity\Todo;
use Doctrine\ORM\EntityManagerInterface;
use Overblog\GraphQLBundle\Definition\Resolver\AliasedInterface;
use Overblog\GraphQLBundle\Definition\Resolver\ResolverInterface;

class TodoListResolver implements ResolverInterface, AliasedInterface {

    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    /**
     * @param $args
     * @return array
     */
    public function resolve($args): array
    {
        if ($args["criteria"] === null) {
            $todos = $this->em->getRepository(Todo::class)->findBy(
                [],
                ['deadline' => "asc"],
                $args['limit']
            );

            return ['todos' => $todos];
        }

        $criteria[] = $args['criteria'];

        $priority[] = $this->em->getRepository(Priority::class)->findBy(
            array(
                "grade" => $criteria[0]
            ),
            ['grade' => "asc"]
        );

        $todos = $this->em->getRepository(Todo::class)->findBy(
            array(
                "priority" => $priority[0]
            ),
            ['deadline' => "asc"],
            $args['limit']
        );

        return ['todos' => $todos];

    }

    public static function getAliases(): array
    {
        return [
            'resolve' => 'TodoList'
        ];
    }
}