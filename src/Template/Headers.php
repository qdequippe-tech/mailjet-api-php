<?php

namespace Qdequippe\Mailjet\Template;

class Headers
{
    /**
     * @var string|null
     */
    private $from;

    /**
     * @var string|null
     */
    private $subject;

    /**
     * @var string|null
     */
    private $replyTo;

    public function __construct(array $input)
    {
        $this->from = $input['From'] ?? null;
        $this->subject = $input['Subject'] ?? null;
        $this->replyTo = $input['Reply-to'] ?? null;
    }

    public static function create($input): self
    {
        return $input instanceof self ? $input : new self($input);
    }

    public function getFrom(): ?string
    {
        return $this->from;
    }

    public function getSubject(): ?string
    {
        return $this->subject;
    }

    public function getReplyTo(): ?string
    {
        return $this->replyTo;
    }
}
