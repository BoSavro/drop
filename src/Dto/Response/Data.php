<?php

declare(strict_types=1);

namespace Poisondrop\Response;

final class Data
{
    /**
     * @var Product[]
    */
    private array $products;

    public function getProducts(): array
    {
        return $this->products;
    }

    public function setProducts(array $products): void
    {
        $this->products = $products;
    }
}
