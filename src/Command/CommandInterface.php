<?php

declare(strict_types=1);

namespace Poisondrop\Command;

interface CommandInterface
{
    public function execute(array $params=[]): object;
}
