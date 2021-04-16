<?php

namespace Qdequippe\Mailjet\SendEmail;

class Attachment
{
    /**
     * @var string|null
     */
    private $contentType;

    /**
     * @var string|null
     */
    private $filename;

    /**
     * @var string|null
     */
    private $base64Content;

    /**
     * @var string|null
     */
    private $contentId;

    public function __construct(array $input)
    {
        $this->contentType = $input['ContentType'] ?? null;
        $this->filename = $input['Filename'] ?? null;
        $this->base64Content = $input['Base64Content'] ?? null;
        $this->contentId = $input['ContentID'] ?? null;
    }

    public static function create($input): self
    {
        return $input instanceof self ? $input : new self($input);
    }

    public function requestBody(): array
    {
        $payload = [];

        if (null !== ($v = $this->contentType)) {
            $payload['ContentType'] = $v;
        }

        if (null !== ($v = $this->filename)) {
            $payload['Filename'] = $v;
        }

        if (null !== ($v = $this->base64Content)) {
            $payload['Base64Content'] = $v;
        }

        if (null !== ($v = $this->contentId)) {
            $payload['ContentID'] = $v;
        }

        return $payload;
    }
}
