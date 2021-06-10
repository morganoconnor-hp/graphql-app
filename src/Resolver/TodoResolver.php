<?php

namespace App\Resolver;

use App\Entity\Todo;
use App\Repository\TodoRepository;
use Overblog\GraphQLBundle\Definition\Resolver\AliasedInterface;
use Overblog\GraphQLBundle\Definition\Resolver\ResolverInterface;

final class TodoResolver implements ResolverInterface, AliasedInterface
{
    /**
     * @var TodoRepository
     */
    private $todoRepository;

    /**
     * @param TodoRepository $todoRepository
     */
    public function __construct(TodoRepository $todoRepository)
    {
        $this->todoRepository = $todoRepository;
    }

    /**
     * @param int $id
     * @return Todo
     */
    public function resolve(int $id): Todo
    {
        return $this->todoRepository->find($id);
    }

    /**
     * {@inheritdoc}
     */
    public static function getAliases(): array
    {
        return [
            'resolve' => 'Todo',
        ];
    }
}