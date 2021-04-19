<?php

declare(strict_types=1);

namespace Poisondrop\Factory;

use Poisondrop\Command\CommandInterface;
use Poisondrop\Command\GetProductJson;
use Poisondrop\Enum\MethodEnum;
use Poisondrop\Exception\FactoryException;

class MethodFactory
{
    public function __construct(
        private GetProductJson $getProductJson,
    ) { }

    public function createMethod(string $method): CommandInterface
    {
        return match ($method) {
            MethodEnum::GET_PRODUCT => $this->getProductJson,
            default => throw new FactoryException(sprintf('Method by name %s does not exist', $method))
        };
    }
}
