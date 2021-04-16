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

    public function __construct(ResponseInterface $response)
    {
        $this->response = $response;
    }

    public function getMessages(): ?array
    {
        $data = $this->response->toArray();

        $this->populate($data);

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
}
