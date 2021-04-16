<?php

namespace Qdequippe\Mailjet\Test;

use Qdequippe\Mailjet\SendEmailResponse;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpClient\MockHttpClient;
use Symfony\Component\HttpClient\Response\MockResponse;

class SendEmailResponseTest extends TestCase
{
    public function testSendEmailResponseFailed(): void
    {
        $response = new MockResponse('{}');
        $client = new MockHttpClient($response);

        $sendEmailResponse = new SendEmailResponse($client->request('POST', 'http://localhost'));

        self::assertNull($sendEmailResponse->getMessages());
    }

    public function testSendEmailResponseSuccess(): void
    {
        $response = new MockResponse(file_get_contents(__DIR__.'/response_success.json'));
        $client = new MockHttpClient($response);

        $sendEmailResponse = new SendEmailResponse($client->request('POST', 'http://localhost'));

        self::assertCount(1, $sendEmailResponse->getMessages());
        $message = $sendEmailResponse->getMessages()[0];
        self::assertSame('success', $message->getStatus());
        self::assertSame('john.doe@example.com', $message->getTo()[0]->getEmail());
        self::assertSame('0b065db3-b585-4664-8564-f4317d3d0820', $message->getTo()[0]->getUuid()->toString());
        self::assertSame(123, $message->getTo()[0]->getId());
        self::assertSame('https://api.mailjet.com/v3/message/123', $message->getTo()[0]->getHref());
        self::assertSame('jane.doe@example.com', $message->getCc()[0]->getEmail());
        self::assertSame('henry.doe@example.com', $message->getBcc()[0]->getEmail());
    }

    public function testSendEmailResponseError(): void
    {
        $response = new MockResponse(file_get_contents(__DIR__.'/response_error.json'));
        $client = new MockHttpClient($response);

        $sendEmailResponse = new SendEmailResponse($client->request('POST', 'http://localhost'));

        self::assertCount(1, $sendEmailResponse->getMessages());
        $message = $sendEmailResponse->getMessages()[0];
        self::assertSame('error', $message->getStatus());
        self::assertCount(2, $message->getErrors());
        self::assertSame('b0c5e274-3b27-42ce-9295-b18dc67c35ca', $message->getErrors()[0]->getIdentifier()->toString());
        self::assertSame('mj-0004', $message->getErrors()[0]->getCode());
        self::assertSame(400, $message->getErrors()[0]->getStatusCode());
        self::assertSame("Type mismatch. Expected type \"array of emails\".", $message->getErrors()[0]->getMessage());
        self::assertSame(['HTMLPart', 'TemplateID'], $message->getErrors()[0]->getRelatedTo());
    }
}
