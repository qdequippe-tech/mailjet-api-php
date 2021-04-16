<?php

namespace Qdequippe\Mailjet;

use Symfony\Component\HttpClient\HttpClient;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class SendApi
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

    public function send($input): SendEmailResponse
    {
        $input = SendEmailRequest::create($input);

        $response = $this->httpClient->request(
            'POST',
            sprintf('%s/v3.1/send', $this->baseUrl),
            [
                'auth_basic' => [$this->publicApiKey, $this->privateApiKey],
                'json' => $input->requestBody(),
            ]
        );

        return new SendEmailResponse($response);
    }
}
