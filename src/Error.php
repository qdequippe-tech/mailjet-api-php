<?php

namespace Qdequippe\Mailjet;

use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

class Error
{
    /**
     * @var UuidInterface|null
     */
    private $identifier;

    /**
     * @var string|null
     */
    private $code;

    /**
     * @var int|null
     */
    private $statusCode;

    /**
     * @var string|null
     */
    private $message;

    /**
     * @var array|null
     */
    private $relatedTo;

    public function __construct(array $input)
    {
        $this->identifier = isset($input['ErrorIdentifier']) ? Uuid::fromString($input['ErrorIdentifier']) : null;
        $this->code = $input['ErrorCode'] ?? null;
        $this->statusCode = $input['StatusCode'] ?? null;
        $this->message = $input['ErrorMessage'] ?? null;
        $this->relatedTo = $input['ErrorRelatedTo'] ?? null;
    }

    public static function create($input): self
    {
        return $input instanceof self ? $input : new self($input);
    }

    public function getIdentifier(): ?UuidInterface
    {
        return $this->identifier;
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function getStatusCode(): ?int
    {
        return $this->statusCode;
    }

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function getRelatedTo(): ?array
    {
        return $this->relatedTo;
    }
}
