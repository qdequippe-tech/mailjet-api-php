<?php

namespace Qdequippe\Mailjet;

use Symfony\Component\HttpClient\HttpClient;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Contracts\HttpClient\ResponseInterface;

abstract class AbstractApi
{
    /**
     * @var HttpClientInterface
     */
    private $httpClient;

    /**
     * @var string|null
     */
    private $publicApiKey;

    /**
     * @var string|null
     */
    private $privateApiKey;

    private $baseUrl = 'https://api.mailjet.com';

    public function __construct(?string $publicApiKey = null, ?string $privateApiKey = null, ?HttpClientInterface $httpClient = null)
    {
        if (null === $httpClient) {
            $httpClient = HttpClient::create();
        }

        $this->httpClient = $httpClient;
        $this->publicApiKey = $publicApiKey;
        $this->privateApiKey = $privateApiKey;
    }

    public function authenticate(array $credentials): void
    {
        $this->publicApiKey = $credentials['publicApiKey'] ?? null;
        $this->privateApiKey = $credentials['privateApiKey'] ?? null;
    }

    final protected function request(string $method, string $uri, ?array $body = null): ResponseInterface
    {
        return $this->httpClient->request(
            $method,
            sprintf('%s/%s/%s', $this->baseUrl, $this->getVersion(), $uri),
            [
                'auth_basic' => [$this->publicApiKey, $this->privateApiKey],
                'json' => $body,
            ]
        );
    }

    protected function getVersion(): string
    {
        return 'v3';
    }
}
