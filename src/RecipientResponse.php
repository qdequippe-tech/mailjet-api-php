<?php

namespace Qdequippe\Mailjet;

use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

class RecipientResponse
{
    /**
     * @var string|null
     */
    private $email;

    /**
     * @var UuidInterface|null
     */
    private $uuid;

    /**
     * @var int|null
     */
    private $id;

    /**
     * @var string|null
     */
    private $href;

    public function __construct(array $input)
    {
        $this->email = $input['Email'] ?? null;
        $this->uuid = isset($input['MessageUUID']) ? Uuid::fromString($input['MessageUUID']) : null;
        $this->id = $input['MessageID'] ?? null;
        $this->href = $input['MessageHref'] ?? null;
    }

    public static function create($input): self
    {
        return $input instanceof self ? $input : new self($input);
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function getUuid(): ?UuidInterface
    {
        return $this->uuid;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getHref(): ?string
    {
        return $this->href;
    }
}
