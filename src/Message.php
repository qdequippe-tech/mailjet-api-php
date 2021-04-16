<?php

namespace Qdequippe\Mailjet;

class Message
{
    /**
     * @var EmailAddress|null
     */
    private $from;

    /**
     * @var EmailAddress[]|null
     */
    private $to;

    /**
     * @var EmailAddress[]|null
     */
    private $cc;

    /**
     * @var EmailAddress[]|null
     */
    private $bcc;

    /**
     * @var string|null
     */
    private $subject;

    /**
     * @var string|null
     */
    private $textPart;

    /**
     * @var string|null
     */
    private $htmlPart;

    /**
     * @var int|null
     */
    private $templateId;

    /**
     * @var bool|null
     */
    private $templateLanguage;

    /**
     * @var string|null
     */
    private $customCampaign;

    /**
     * @var bool|null
     */
    private $deduplicateCampaign;

    public function __construct(array $input)
    {
        $this->from = isset($input['From']) ? EmailAddress::create($input['From']) : null;

        if (isset($input['To'])) {
            foreach ($input['To'] as $data) {
                $this->to[] = EmailAddress::create($data);
            }
        }
        if (isset($input['Cc'])) {
            foreach ($input['Cc'] as $data) {
                $this->cc[] = EmailAddress::create($data);
            }
        }
        if (isset($input['Bcc'])) {
            foreach ($input['Bcc'] as $data) {
                $this->bcc[] = EmailAddress::create($data);
            }
        }

        $this->subject = $input['Subject'] ?? null;
        $this->textPart = $input['TextPart'] ?? null;
        $this->htmlPart = $input['HTMLPart'] ?? null;
        $this->templateId = $input['TemplateID'] ?? null;
        $this->templateLanguage = $input['TemplateLanguage'] ?? null;
        $this->customCampaign = $input['CustomCampaign'] ?? null;
        $this->deduplicateCampaign = $input['DeduplicateCampaign'] ?? null;
    }

    public static function create($input): self
    {
        return $input instanceof self ? $input : new self($input);
    }

    public function requestBody(): array
    {
        $payload = [];

        if (null !== ($v = $this->from)) {
            $payload['From'] = $v->requestBody();
        }

        if (null !== ($v = $this->to)) {
            $payload['To'] = [];
            foreach ($v as $item) {
                $payload['To'][] = $item->requestBody();
            }
        }

        if (null !== ($v = $this->cc)) {
            $payload['Cc'] = [];
            foreach ($v as $item) {
                $payload['Cc'][] = $item->requestBody();
            }
        }

        if (null !== ($v = $this->bcc)) {
            $payload['Bcc'] = [];
            foreach ($v as $item) {
                $payload['Bcc'][] = $item->requestBody();
            }
        }

        if (null !== ($v = $this->subject)) {
            $payload['Subject'] = $v;
        }

        if (null !== ($v = $this->textPart)) {
            $payload['TextPart'] = $v;
        }

        if (null !== ($v = $this->htmlPart)) {
            $payload['HTMLPart'] = $v;
        }

        if (null !== ($v = $this->templateId)) {
            $payload['TemplateID'] = $v;
        }

        if (null !== ($v = $this->templateLanguage)) {
            $payload['TemplateLanguage'] = $v;
        }

        if (null !== ($v = $this->customCampaign)) {
            $payload['CustomCampaign'] = $v;
        }

        if (null !== ($v = $this->deduplicateCampaign)) {
            $payload['DeduplicateCampaign'] = $v;
        }

        return $payload;
    }
}