<?php

declare(strict_types=1);

namespace Poisondrop\Service;

interface ClientServiceInterface
{
    public function buildRequest(string $method, string $url, array $params=[]): string;
    public function buildGetRequest(string $url, array $params=[]): string;
    public function buildPostRequest(string $url, array $params=[]): string;
}
