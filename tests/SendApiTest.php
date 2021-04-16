<?php

namespace Qdequippe\Mailjet\Test;

use Qdequippe\Mailjet\EmailAddress;
use Qdequippe\Mailjet\Message;
use Qdequippe\Mailjet\SendApi;
use PHPUnit\Framework\TestCase;
use Qdequippe\Mailjet\SendEmailRequest;
use Symfony\Component\HttpClient\MockHttpClient;
use Symfony\Component\HttpClient\Response\MockResponse;

class SendApiTest extends TestCase
{
    public function testSend(): void
    {
        $response = new MockResponse('{
            "Messages":[{"Status":"success","To":[{"Email":"john.doe@example.com","MessageUUID":"0b065db3-b585-4664-8564-f4317d3d0820","MessageID":123,"MessageHref":"https:\/\/api.mailjet.com\/v3\/message\/123"}]}]
        }');

        $client = new MockHttpClient($response);

        $sendApi = new SendApi(null, null, $client);

        $sendEmailRequest = new SendEmailRequest([
            'Messages' => [
                new Message([
                    'From' => new EmailAddress([
                        'Email' => 'jane.doe@example.com',
                        'Name' => 'Jane Doe',
                    ]),
                    'To' => new EmailAddress([
                        'Email' => 'john.doe@example.com',
                        'Name' => 'John Doe',
                    ]),
                    'Subject' => 'Hello World!',
                    'TextPart' => 'Hello World!',
                    'HTMLPart' => '<p>Hello World!</p>'
                ])
            ]
        ]);

        $sendEmailResponse = $sendApi->send($sendEmailRequest);

        self::assertNotNull($sendEmailResponse->getMessages());
        $message = $sendEmailResponse->getMessages()[0];

        self::assertSame('success', $message->getStatus());
    }
}
