<?php

namespace Qdequippe\Mailjet\SendEmail;

use Qdequippe\Mailjet\AbstractApi;

class SendApi extends AbstractApi
{
    public function send($input): SendEmailResponse
    {
        $input = SendEmailRequest::create($input);

        $response = $this->request(
            'POST',
            'send',
            $input->requestBody()
        );

        return new SendEmailResponse($response);
    }

    protected function getVersion(): string
    {
        return 'v3.1';
    }
}
