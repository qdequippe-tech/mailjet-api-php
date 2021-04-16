<?php

namespace Qdequippe\Mailjet\Test;

use Qdequippe\Mailjet\SendEmailResponse;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpClient\MockHttpClient;
use Symfony\Component\HttpClient\Response\MockResponse;

class SendEmailResponseTest extends TestCase
{
    public function testGetMessages(): void
    {
        $response = new MockResponse('{
            "Messages":[{"Status":"success","To":{"Email":"john.doe@example.com","MessageUUID":"0b065db3-b585-4664-8564-f4317d3d0820","MessageID":123,"MessageHref":"https:\/\/api.mailjet.com\/v3\/message\/123"}}]
        }');
        $client = new MockHttpClient($response);

        $sendEmailResponse = new SendEmailResponse($client->request('POST', 'http://localhost'));

        self::assertCount(1, $sendEmailResponse->getMessages());
        $message =  $sendEmailResponse->getMessages()[0];
        self::assertSame('success', $message->getStatus());
        self::assertSame('john.doe@example.com', $message->getTo()->getEmail());
        self::assertSame('0b065db3-b585-4664-8564-f4317d3d0820', $message->getTo()->getUuid()->toString());
        self::assertSame(123, $message->getTo()->getId());
        self::assertSame('https://api.mailjet.com/v3/message/123', $message->getTo()->getHref());
    }
}
