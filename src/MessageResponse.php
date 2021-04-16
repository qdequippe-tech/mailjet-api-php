<?php

namespace Qdequippe\Mailjet;

class MessageResponse
{
    /**
     * @var RecipientResponse|null
     */
    private $to;

    /**
     * @var RecipientResponse|null
     */
    private $cc;

    /**
     * @var RecipientResponse|null
     */
    private $bcc;

    /**
     * @var string|null
     */
    private $status;

    public function __construct(array $input)
    {
        $this->status = $input['Status'] ?? null;
        $this->to = isset($input['To']) ? RecipientResponse::create($input['To']) : null;
        $this->cc = isset($input['Cc']) ? RecipientResponse::create($input['Cc']) : null;
        $this->bcc = isset($input['Bcc']) ? RecipientResponse::create($input['Bcc']) : null;
    }

    public static function create($input): self
    {
        return $input instanceof self ? $input : new self($input);
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function getTo(): ?RecipientResponse
    {
        return $this->to;
    }

    public function getCc(): ?RecipientResponse
    {
        return $this->cc;
    }

    public function getBcc(): ?RecipientResponse
    {
        return $this->bcc;
    }
}
