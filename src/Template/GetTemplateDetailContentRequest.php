<?php

namespace Qdequippe\Mailjet\Template;

class GetTemplateDetailContentRequest
{
    /**
     * @var ?string
     */
    private $templateId;

    public function __construct(array $input)
    {
        $this->templateId = $input['template_ID'] ?? null;
    }

    public static function create($input): self
    {
        return $input instanceof self ? $input : new self($input);
    }

    public function getTemplateId(): ?string
    {
        return $this->templateId;
    }
}
