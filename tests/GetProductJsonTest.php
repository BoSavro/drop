<?php

declare(strict_types=1);

namespace Poisondrop\Tests;

use PHPUnit\Framework\TestCase;
use Poisondrop\Command\GetProductJson;
use Poisondrop\Dto\Response\ProductResponse;
use Poisondrop\Service\ClientServiceInterface;
use Symfony\Component\PropertyAccess\PropertyAccess;
use Symfony\Component\PropertyInfo\Extractor\ReflectionExtractor;
use Symfony\Component\PropertyInfo\PropertyInfoExtractor;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Exception\NotEncodableValueException;
use Symfony\Component\Serializer\Normalizer\ArrayDenormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\SerializerInterface;
use Throwable;

class GetProductJsonTest extends TestCase
{
    private SerializerInterface $serializer;
    private GetProductJson $getProductJson;

    public function setUp(): void
    {
        $clientService = $this->createMock(ClientServiceInterface::class);

        $encoder          = [new JsonEncoder()];
        $extractor        = new PropertyInfoExtractor(
            [],
            [new ReflectionExtractor()]
        );
        $normalizer       = [
            new ArrayDenormalizer(),
            new ObjectNormalizer(
                null,
                null,
                null,
                $extractor
            ),
        ];
        $this->serializer = new Serializer($normalizer, $encoder);

        $this->getProductJson = new GetProductJson(
            $clientService,
            $this->serializer
        );
    }

    public function testSerializer(): void
    {
        $response         = file_get_contents('/var/www/tests/products.json');
        $products         = $this->serializer->deserialize($response, ProductResponse::class, 'json');
        $propertyAccessor = PropertyAccess::createPropertyAccessor();
        $firstProductName = $propertyAccessor->getValue($products, 'data.products[0][name]');
        $this->assertEquals('Товар 1', $firstProductName);
    }

    public function testExecuteMethodGotWrongDataFormat(): void
    {
        try {
            $this->getProductJson->execute([]);
        } catch (Throwable $e) {
            $this->assertInstanceOf(NotEncodableValueException::class, $e);
        }
    }
}
