<?php

declare(strict_types=1);

namespace Poisondrop\Dto\Response;

final class ProductResponse
{
    private Data $data;
    private bool $success;

    public function getData(): Data
    {
        return $this->data;
    }

    public function setData(Data $data): ProductResponse
    {
        $this->data = $data;
        return $this;
    }

    public function isSuccess(): bool
    {
        return $this->success;
    }

    public function setSuccess(bool $success): ProductResponse
    {
        $this->success = $success;
        return $this;
    }
}
