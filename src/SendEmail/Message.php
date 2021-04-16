<?php

namespace Qdequippe\Mailjet\SendEmail;

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

    /**
     * @var array|null
     */
    private $variables;

    /**
     * @var array|null
     */
    private $headers;

    /**
     * @var string|null
     */
    private $customId;

    /**
     * @var string|null
     */
    private $eventPayload;

    /**
     * @var string|null
     */
    private $urlTags;

    /**
     * @var Attachment[]|null
     */
    private $attachments;

    /**
     * @var Attachment[]|null
     */
    private $inlinedAttachments;

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

        if (isset($input['Attachments'])) {
            foreach ($input['Attachments'] as $data) {
                $this->attachments[] = Attachment::create($data);
            }
        }

        if (isset($input['InlinedAttachments'])) {
            foreach ($input['InlinedAttachments'] as $data) {
                $this->inlinedAttachments[] = Attachment::create($data);
            }
        }

        $this->subject = $input['Subject'] ?? null;
        $this->textPart = $input['TextPart'] ?? null;
        $this->htmlPart = $input['HTMLPart'] ?? null;
        $this->templateId = $input['TemplateID'] ?? null;
        $this->templateLanguage = $input['TemplateLanguage'] ?? null;
        $this->customCampaign = $input['CustomCampaign'] ?? null;
        $this->deduplicateCampaign = $input['DeduplicateCampaign'] ?? null;
        $this->variables = $input['Variables'] ?? null;
        $this->headers = $input['Headers'] ?? null;
        $this->customId = $input['CustomID'] ?? null;
        $this->eventPayload = $input['EventPayload'] ?? null;
        $this->urlTags = $input['URLTags'] ?? null;
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

        if (null !== ($v = $this->variables)) {
            $payload['Variables'] = [];
            foreach ($v as $key => $value) {
                $payload['Variables'][$key] = $value;
            }
        }

        if (null !== ($v = $this->headers)) {
            $payload['Headers'] = [];
            foreach ($v as $key => $value) {
                $payload['Headers'][$key] = $value;
            }
        }

        if (null !== ($v = $this->customId)) {
            $payload['CustomID'] = $v;
        }

        if (null !== ($v = $this->eventPayload)) {
            $payload['EventPayload'] = $v;
        }

        if (null !== ($v = $this->urlTags)) {
            $payload['URLTags'] = $v;
        }

        if (null !== ($v = $this->attachments)) {
            $payload['Attachments'] = [];
            foreach ($v as $item) {
                $payload['Attachments'][] = $item->requestBody();
            }
        }

        if (null !== ($v = $this->inlinedAttachments)) {
            $payload['InlinedAttachments'] = [];
            foreach ($v as $item) {
                $payload['InlinedAttachments'][] = $item->requestBody();
            }
        }

        return $payload;
    }
}
