<?php

namespace Qdequippe\Mailjet;

class EmailAddress
{
    /**
     * @var string|null
     */
    private $email;

    /**
     * @var string|null
     */
    private $name;

    public function __construct(array $input)
    {
        $this->email = $input['Email'] ?? null;
        $this->name = $input['Name'] ?? null;
    }

    public static function create($input): self
    {
        return $input instanceof self ? $input : new self($input);
    }

    public function requestBody(): array
    {
        $payload = [];

        if (null !== ($v = $this->email)) {
            $payload['Email'] = $v;
        }

        if (null !== ($v = $this->name)) {
            $payload['Name'] = $v;
        }

        return $payload;
    }
}