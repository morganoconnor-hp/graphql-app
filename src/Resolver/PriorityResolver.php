<?php

namespace App\Resolver;

use App\Entity\Priority;
use App\Repository\PriorityRepository;
use Overblog\GraphQLBundle\Definition\Resolver\AliasedInterface;
use Overblog\GraphQLBundle\Definition\Resolver\ResolverInterface;

final class PriorityResolver implements ResolverInterface, AliasedInterface
{
    /**
     * @var PriorityRepository
     */
    private $priorityRepository;

    /**
     * @param PriorityRepository $priorityRepository
     */
    public function __construct(PriorityRepository $priorityRepository)
    {
        $this->priorityRepository = $priorityRepository;
    }

    /**
     * @param int $id
     * @return Priority
     */
    public function resolve(int $id): Priority
    {
        return $this->priorityRepository->find($id);
    }

    /**
     * {@inheritdoc}
     */
    public static function getAliases(): array
    {
        return [
            'resolve' => 'Priority',
        ];
    }
}