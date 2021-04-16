<?php

namespace Qdequippe\Mailjet;

use Symfony\Contracts\HttpClient\ResponseInterface;

abstract class Response
{
    /**
     * @var ResponseInterface
     */
    protected $response;

    /**
     * @var bool
     */
    private $initialized = false;

    public function __construct(ResponseInterface $response)
    {
        $this->response = $response;
    }

    abstract protected function populate(array $data): void;

    protected function initialize(): void
    {
        if ($this->initialized) {
            return;
        }

        $data = $this->response->toArray();

        $this->populate($data);
        $this->initialized = true;
    }
}
