<?php

declare(strict_types=1);

namespace Poisondrop\Exception;

final class ProductException
{
    private Date $data;
    private bool $success;

    public function getData(): Date
    {
        return $this->data;
    }

    public function setData(Date $data): ProductException
    {
        $this->data = $data;
        return $this;
    }

    public function isSuccess(): bool
    {
        return $this->success;
    }

    public function setSuccess(bool $success): ProductException
    {
        $this->success = $success;
        return $this;
    }
}
