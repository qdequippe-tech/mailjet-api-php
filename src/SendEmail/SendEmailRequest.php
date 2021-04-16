<?php

namespace Qdequippe\Mailjet\SendEmail;

final class SendEmailRequest
{
    /**
     * @var Message[]|null
     */
    private $messages;

    /**
     * @var bool|null
     */
    private $sandboxMode;

    /**
     * @var Message|null
     */
    private $globals;

    public function __construct(array $input = [])
    {
        if (isset($input['Messages'])) {
            foreach ($input['Messages'] as $message) {
                $this->messages[] = Message::create($message);
            }
        }

        $this->sandboxMode = $input['SandboxMode'] ?? null;
        $this->globals = isset($input['Globals']) ? Message::create($input['Globals']) : null;
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

        if (null !== ($v = $this->sandboxMode)) {
            $payload['SandboxMode'] = $v;
        }

        if (null !== ($v = $this->globals)) {
            $payload['Globals'] = $v->requestBody();
        }

        return $payload;
    }
}
