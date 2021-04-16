<?php

namespace Qdequippe\Mailjet\Template;

use Qdequippe\Mailjet\PaginatedResponse;

/**
 * @method TemplateDetailContent[] getData()
 */
class GetTemplateDetailContentResponse extends PaginatedResponse
{
    protected function populateData(array $data): void
    {
        $this->data[] = TemplateDetailContent::create($data[0]);
    }
}
