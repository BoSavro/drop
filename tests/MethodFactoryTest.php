<?php

declare(strict_types=1);

namespace Poisondrop\Tests;

use PHPUnit\Framework\TestCase;
use Poisondrop\Command\CommandInterface;
use Poisondrop\Command\GetProductJson;
use Poisondrop\Enum\MethodEnum;
use Poisondrop\Exception\FactoryException;
use Poisondrop\Factory\MethodFactory;
use Throwable;

class MethodFactoryTest extends TestCase
{
    private MethodFactory $methodFactory;

    protected function setUp(): void
    {
        $getProductJson      = $this->createMock(GetProductJson::class);
        $this->methodFactory = new MethodFactory($getProductJson);
    }

    public function testFactoryReturnCommandInterface(): void
    {
        $result = $this->methodFactory->createMethod(MethodEnum::GET_PRODUCT);
        $this->assertInstanceOf(CommandInterface::class, $result);
    }

    public function testFactoryReturnException(): void
    {
        try {
            $this->methodFactory->createMethod('sdfsdf');
        } catch (Throwable $e) {
            $this->assertInstanceOf(FactoryException::class, $e);
        }
    }
}
