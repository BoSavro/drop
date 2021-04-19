<?php

declare(strict_types=1);

namespace Poisondrop\Response;

final class ProductResponse
{
    private Data $date;
    private bool $success;

    public function getDate(): Data
    {
        return $this->date;
    }

    public function setDate(Data $date): ProductResponse
    {
        $this->date = $date;
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
