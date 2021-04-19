<?php

declare(strict_types=1);

namespace Poisondrop\Exception;

final class Date
{
    private string $message;
    private string $code;

    public function getMessage(): string
    {
        return $this->message;
    }

    public function setMessage(string $message): Date
    {
        $this->message = $message;
        return $this;
    }

    public function getCode(): string
    {
        return $this->code;
    }

    public function setCode(string $code): Date
    {
        $this->code = $code;
        return $this;
    }
}
