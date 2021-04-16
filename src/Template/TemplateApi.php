<?php

namespace Qdequippe\Mailjet\Template;

use Qdequippe\Mailjet\AbstractApi;

class TemplateApi extends AbstractApi
{
    public function getTemplate($input): GetTemplateResponse
    {
        $input = GetTemplateRequest::create($input);

        $response = $this->request(
            'GET',
            sprintf('REST/template/%s', $input->getTemplateId())
        );

        return new GetTemplateResponse($response);
    }

    public function getTemplateDetailContent($input): GetTemplateDetailContentResponse
    {
        $input = GetTemplateDetailContentRequest::create($input);

        $response = $this->request(
            'GET',
            sprintf('REST/template/%s/detailcontent', $input->getTemplateId())
        );

        return new GetTemplateDetailContentResponse($response);
    }
}
