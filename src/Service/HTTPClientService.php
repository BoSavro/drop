<?php

declare(strict_types=1);

namespace Poisondrop\Service;

use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;
use Poisondrop\Enum\HTTPMethodEnum;
use Symfony\Component\HttpFoundation\Request;

class HTTPClientService implements ClientServiceInterface
{
    public function __construct(
        private string $host,
    ) { }

    public function buildRequest(string $method, string $url, array $params=[]): string
    {
        $client   = $this->getClient();
        $response = $client->request($method, $url, [RequestOptions::JSON => $params])->getBody();

        return (string) $response;
    }

    public function buildGetRequest(string $url, array $params=[]): string
    {
        $client   = $this->getClient();
        $response = $client->request(HTTPMethodEnum::METHOD_GET, $url, [RequestOptions::QUERY => $params])->getBody();

        return (string) $response;
    }

    public function buildPostRequest(string $url, array $params=[]): string
    {
        $client   = $this->getClient();
        $response = $client->request(HTTPMethodEnum::METHOD_POST, $url, [RequestOptions::JSON => $params])->getBody();

        return (string) $response;
    }

    private function getClient(): Client
    {
        return new Client([
            'base_uri' => $this->host,
            'headers'  => [
                'Content-Type' => 'application/json',
                'Accept'       => 'application/json',
            ],
        ]);
    }
}
