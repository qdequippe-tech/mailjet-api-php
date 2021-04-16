<?php

namespace Qdequippe\Mailjet;

abstract class PaginatedResponse extends Response
{
    /**
     * @var array|null
     */
    protected $data;

    /**
     * @var int|null
     */
    private $count;

    /**
     * @var int|null
     */
    private $total;

    public function getCount(): ?int
    {
        return $this->count;
    }

    public function getTotal(): ?int
    {
        return $this->total;
    }

    public function getData(): ?array
    {
        $this->initialize();

        return $this->data;
    }

    protected function populate(array $data): void
    {
        $this->count = $data['Count'] ?? null;
        $this->total = $data['Total'] ?? null;

        $this->populateData($data['Data']);
    }

    abstract protected function populateData(array $data): void;
}
