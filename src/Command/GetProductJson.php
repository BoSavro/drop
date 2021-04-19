<?php

declare(strict_types=1);

namespace Poisondrop\Command;

use Poisondrop\Dto\Response\ProductResponse;
use Poisondrop\Exception\ApiException;
use Poisondrop\Exception\ProductException;
use Poisondrop\Service\ClientServiceInterface;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Exception\NotNormalizableValueException;
use Symfony\Component\Serializer\SerializerInterface;

class GetProductJson implements CommandInterface
{
    public function __construct(
        private ClientServiceInterface $clientService,
        private SerializerInterface $serializer,
    ) { }

    public function execute(array $params=[]): ProductResponse
    {
        $response = $this->clientService->buildGetRequest('/products', $params);

        try {
            $result = $this->serializer->deserialize(
                $response,
                ProductResponse::class,
                JsonEncoder::FORMAT
            );
        } catch (NotNormalizableValueException $exception) {
            $result = $this->serializer->deserialize(
                $response,
                ProductException::class,
                JsonEncoder::FORMAT
            );

            assert($result instanceof ProductException);

            throw new ApiException(
                sprintf('Request failed with message %s and code %s',
                    $result->getData()->getMessage(),
                    $result->getData()->getCode()
                )
            );
        }

        return $result;
    }
}
