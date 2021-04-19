<?php

declare(strict_types=1);

namespace Poisondrop;

use Poisondrop\Enum\MethodEnum;
use Poisondrop\Factory\MethodFactory;

class Client
{
    public function __construct(
        private MethodFactory $factory,
    ) { }

    public function execute(string $method, array $params): object
    {
       $command = $this->factory->createMethod($method);
       return $command->execute($params);
    }

    public function getProduct(): object
    {
        $command = $this->factory->createMethod(MethodEnum::GET_PRODUCT);
        return $command->execute();
    }
}
