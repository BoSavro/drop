<?php

declare(strict_types=1);

namespace Poisondrop\Response;

final class Product
{
    private string $vendorCode;
    private string $name;
    private int $price;
    private array $features;

    public function getVendorCode(): string
    {
        return $this->vendorCode;
    }

    public function setVendorCode(string $vendorCode): Product
    {
        $this->vendorCode = $vendorCode;
        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): Product
    {
        $this->name = $name;
        return $this;
    }

    public function getPrice(): int
    {
        return $this->price;
    }

    public function setPrice(int $price): Product
    {
        $this->price = $price;
        return $this;
    }

    public function getFeatures(): array
    {
        return $this->features;
    }

    public function setFeatures(array $features): Product
    {
        $this->features = $features;
        return $this;
    }
}
