<?php

namespace Qdequippe\Mailjet\Template;

class TemplateDetailContent
{
    /**
     * @var Headers|null
     */
    private $headers;

    /**
     * @var string|null
     */
    private $htmlPart;

    /**
     * @var string|null
     */
    private $mjmlContent;

    /**
     * @var string|null
     */
    private $textPart;

    public function __construct(array $input)
    {
        $this->headers = isset($input['Headers']) ? Headers::create($input['Headers']) : null;
        $this->htmlPart = $input['Html-part'] ?? null;
        $this->mjmlContent = $input['MJMLContent'] ?? null;
        $this->textPart = $input['Text-part'] ?? null;
    }

    public static function create($input): self
    {
        return $input instanceof self ? $input : new self($input);
    }

    public function getHeaders(): ?Headers
    {
        return $this->headers;
    }

    public function getHtmlPart()
    {
        return $this->htmlPart;
    }

    public function getMjmlContent()
    {
        return $this->mjmlContent;
    }

    public function getTextPart(): ?string
    {
        return $this->textPart;
    }
}
