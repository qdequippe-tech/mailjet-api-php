<?php

namespace Qdequippe\Mailjet\Template;

use Qdequippe\Mailjet\PaginatedResponse;

/**
 * @method Template[] getData()
 */
class GetTemplateResponse extends PaginatedResponse
{
    protected function populateData(array $data): void
    {
        $this->data[] = Template::create($data[0]);
    }
}
