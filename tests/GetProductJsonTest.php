<?php

declare(strict_types=1);

namespace Poisondrop\Tests;

use PHPUnit\Framework\TestCase;
use Poisondrop\Command\GetProductJson;
use Poisondrop\Service\ClientServiceInterface;
use Symfony\Component\PropertyInfo\Extractor\ReflectionExtractor;
use Symfony\Component\PropertyInfo\PropertyInfoExtractor;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Exception\NotEncodableValueException;
use Symfony\Component\Serializer\Normalizer\ArrayDenormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Throwable;

class GetProductJsonTest extends TestCase
{
    private GetProductJson $getProductJson;
    private ClientServiceInterface $clientService;
    private string $goodResponse;
    private string $badResponse;

    public function setUp(): void
    {
        $this->goodResponse = file_get_contents(__DIR__ . '/products.json');
        $this->badResponse = file_get_contents(__DIR__ . '/bad.json');

        $this->clientService = $this->createMock(ClientServiceInterface::class);

        $encoder    = [new JsonEncoder()];
        $extractor  = new PropertyInfoExtractor(
            [],
            [new ReflectionExtractor()]
        );
        $normalizer = [
            new ArrayDenormalizer(),
            new ObjectNormalizer(
                null,
                null,
                null,
                $extractor
            ),
        ];
        $serializer = new Serializer($normalizer, $encoder);

        $this->getProductJson = new GetProductJson(
            $this->clientService,
            $serializer
        );
    }

    public function testSerializer(): void
    {
        $this->clientService
            ->expects($this->once())
            ->method('buildGetRequest')
            ->willReturn($this->goodResponse);

        $product = $this->getProductJson->execute();
        $this->assertEquals('Товар 1', $product->getData()->getProducts()[0]['name']);
    }

    public function testExecuteMethodGotWrongDataFormat(): void
    {
        try {
            $this->clientService
                ->expects($this->once())
                ->method('buildGetRequest')
                ->willReturn($this->badResponse);

            $product = $this->getProductJson->execute();
            $this->assertEquals(false, $product->isSuccess());
        } catch (Throwable $e) {
            $this->assertInstanceOf(NotEncodableValueException::class, $e);
        }
    }
}
