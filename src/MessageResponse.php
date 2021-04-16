<?php

namespace Qdequippe\Mailjet;

class MessageResponse
{
    /**
     * @var RecipientResponse[]|null
     */
    private $to;

    /**
     * @var RecipientResponse[]|null
     */
    private $cc;

    /**
     * @var RecipientResponse[]|null
     */
    private $bcc;

    /**
     * @var string|null
     */
    private $status;

    public function __construct(array $input)
    {
        $this->status = $input['Status'] ?? null;
        if (isset($input['To'])) {
            foreach ($input['To'] as $item) {
                $this->to[] = RecipientResponse::create($item);
            }
        }

        if (isset($input['Cc'])) {
            foreach ($input['Cc'] as $item) {
                $this->cc[] = RecipientResponse::create($item);
            }
        }

        if (isset($input['Bcc'])) {
            foreach ($input['Bcc'] as $item) {
                $this->bcc[] = RecipientResponse::create($item);
            }
        }
    }

    public static function create($input): self
    {
        return $input instanceof self ? $input : new self($input);
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    /**
     * @return RecipientResponse[]|null
     */
    public function getTo(): ?array
    {
        return $this->to;
    }

    /**
     * @return RecipientResponse[]|null
     */
    public function getCc(): ?array
    {
        return $this->cc;
    }

    /**
     * @return RecipientResponse[]|null
     */
    public function getBcc(): ?array
    {
        return $this->bcc;
    }
}
