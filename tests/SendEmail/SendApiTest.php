<?php

namespace Qdequippe\Mailjet\Tests\SendEmail;

use PHPUnit\Framework\TestCase;
use Qdequippe\Mailjet\SendEmail\EmailAddress;
use Qdequippe\Mailjet\SendEmail\Message;
use Qdequippe\Mailjet\SendEmail\SendApi;
use Qdequippe\Mailjet\SendEmail\SendEmailRequest;
use Symfony\Component\HttpClient\MockHttpClient;
use Symfony\Component\HttpClient\Response\MockResponse;

class SendApiTest extends TestCase
{
    public function testSend(): void
    {
        $response = new MockResponse(file_get_contents(__DIR__ . '/response_success.json'));
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
                    'HTMLPart' => '<p>Hello World!</p>',
                ]),
            ],
        ]);

        $sendEmailResponse = $sendApi->send($sendEmailRequest);

        self::assertNotNull($sendEmailResponse->getMessages());
        $message = $sendEmailResponse->getMessages()[0];

        self::assertSame('success', $message->getStatus());
    }

    public function testSendWithoutClient(): void
    {
        $response = new MockResponse(file_get_contents(__DIR__ . '/response_success.json'));
        $client = new MockHttpClient($response);
        $sendApi = new SendApi();
        $sendApi->authenticate([
            'publicApiKey' => 'xxx',
            'privateApiKey' => 'xxx',
        ]);

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
                    'HTMLPart' => '<p>Hello World!</p>',
                ]),
            ],
        ]);

        // Workaround to set mocked http client
        $reflection = new \ReflectionClass($sendApi);
        $property = $reflection->getParentClass()->getProperty('httpClient');
        $property->setAccessible(true);
        $property->setValue($sendApi, $client);

        $sendEmailResponse = $sendApi->send($sendEmailRequest);

        self::assertNotNull($sendEmailResponse->getMessages());
        $message = $sendEmailResponse->getMessages()[0];

        self::assertSame('success', $message->getStatus());
    }
}
