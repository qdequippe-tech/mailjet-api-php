<?php

namespace Qdequippe\Mailjet\Template;

class Template
{
    /**
     * @var string|null
     */
    private $author;

    /**
     * @var array|null
     */
    private $categories;

    /**
     * @var string|null
     */
    private $copyright;

    /**
     * @var string|null
     */
    private $description;

    /**
     * @var int|null
     */
    private $editMode;

    /**
     * @var bool|null
     */
    private $isStarred;

    /**
     * @var bool|null
     */
    private $isTextPartGenerationEnabled;

    /**
     * @var string|null
     */
    private $locale;

    /**
     * @var string|null
     */
    private $name;

    /**
     * @var string|null
     */
    private $ownerType;

    /**
     * @var array|null
     */
    private $presets;

    /**
     * @var array|null
     */
    private $purposes;

    /**
     * @var int|null
     */
    private $id;

    /**
     * @var int|null
     */
    private $ownerId;

    /**
     * @var array|null
     */
    private $previews;

    /**
     * @var \DateTimeImmutable|null
     */
    private $createdAt;

    /**
     * @var \DateTimeImmutable|null
     */
    private $lastUpdatedAt;

    public function __construct(array $input)
    {
        $this->author = $input['Author'] ?? null;
        $this->categories = $input['Categories'] ?? null;
        $this->copyright = $input['Copyright'] ?? null;
        $this->description = $input['Description'] ?? null;
        $this->editMode = $input['EditMode'] ?? null;
        $this->isStarred = $input['IsStarred'] ?? null;
        $this->isTextPartGenerationEnabled = $input['IsTextPartGenerationEnabled'] ?? null;
        $this->locale = $input['Locale'] ?? null;
        $this->name = $input['Name'] ?? null;
        $this->ownerType = $input['OwnerType'] ?? null;
        $this->presets = isset($input['Presets']) ? json_decode($input['Presets'], true) : null;
        $this->purposes = $input['Purposes'] ?? null;
        $this->id = $input['ID'] ?? null;
        $this->ownerId = $input['OwnerId'] ?? null;
        $this->previews = $input['Previews'] ?? null;
        $this->createdAt = isset($input['CreatedAt']) ? new \DateTimeImmutable($input['CreatedAt']) : null;
        $this->lastUpdatedAt = isset($input['LastUpdatedAt']) ? new \DateTimeImmutable($input['LastUpdatedAt']) : null;
    }

    public static function create($input): self
    {
        return $input instanceof self ? $input : new self($input);
    }

    public function getAuthor(): ?string
    {
        return $this->author;
    }

    public function getCategories(): ?array
    {
        return $this->categories;
    }

    public function getCopyright(): ?string
    {
        return $this->copyright;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function getEditMode(): ?int
    {
        return $this->editMode;
    }

    public function getIsStarred(): ?bool
    {
        return $this->isStarred;
    }

    public function getIsTextPartGenerationEnabled(): ?bool
    {
        return $this->isTextPartGenerationEnabled;
    }

    public function getLocale(): ?string
    {
        return $this->locale;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function getOwnerType(): ?string
    {
        return $this->ownerType;
    }

    public function getPresets(): ?array
    {
        return $this->presets;
    }

    public function getPurposes(): ?array
    {
        return $this->purposes;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getOwnerId(): ?int
    {
        return $this->ownerId;
    }

    public function getPreviews(): ?array
    {
        return $this->previews;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function getLastUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->lastUpdatedAt;
    }
}
