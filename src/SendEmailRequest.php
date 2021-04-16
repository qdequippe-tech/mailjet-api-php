<?php

namespace Qdequippe\Mailjet;

final class SendEmailRequest
{
    /**
     * @var Message[]|null
     */
    private $messages;

    public function __construct(array $input = [])
    {
        if (isset($input['Messages'])) {
            foreach ($input['Messages'] as $message) {
                $this->messages[] = Message::create($message);
            }
        }
    }

    public static function create($input): self
    {
        return $input instanceof self ? $input : new self($input);
    }

    public function requestBody(): array
    {
        $payload = [];

        if (null !== ($v = $this->messages)) {
            $payload['Messages'] = [];
            foreach ($v as $message) {
                $payload['Messages'][] = $message->requestBody();
            }
        }

        return $payload;
    }

    /**
     * @return Message[]|null
     */
    public function getMessages(): ?array
    {
        return $this->messages;
    }
}
