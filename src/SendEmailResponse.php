<?php

namespace Qdequippe\Mailjet;

use Symfony\Contracts\HttpClient\ResponseInterface;

final class SendEmailResponse
{
    /**
     * @var MessageResponse[]|null
     */
    private $messages;

    /**
     * @var ResponseInterface
     */
    private $response;

    /**
     * @var bool
     */
    private $initialized = false;

    public function __construct(ResponseInterface $response)
    {
        $this->response = $response;
    }

    public function getMessages(): ?array
    {
        $this->initialize();

        return $this->messages;
    }

    private function populate(array $data): void
    {
        if (false === isset($data['Messages'])) {
            return;
        }

        foreach ($data['Messages'] as $message) {
            $this->messages[] = MessageResponse::create($message);
        }
    }

    private function initialize(): void
    {
        if ($this->initialized) {
            return;
        }

        $data = $this->response->toArray();

        $this->populate($data);
        $this->initialized = true;
    }
}
