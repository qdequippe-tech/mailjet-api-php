<?php

namespace Qdequippe\Mailjet\Tests\Template;

use PHPUnit\Framework\TestCase;
use Qdequippe\Mailjet\Template\GetTemplateDetailContentRequest;
use Qdequippe\Mailjet\Template\GetTemplateRequest;
use Qdequippe\Mailjet\Template\TemplateApi;
use Symfony\Component\HttpClient\MockHttpClient;
use Symfony\Component\HttpClient\Response\MockResponse;

class TemplateApiTest extends TestCase
{
    public function testGetTemplate(): void
    {
        $response = new MockResponse(file_get_contents(__DIR__ . '/response_get_template.json'));
        $client = new MockHttpClient($response);
        $templateApi = new TemplateApi(null, null, $client);
        $templateResponse = $templateApi->getTemplate(new GetTemplateRequest([
            'template_ID' => 42,
        ]));

        self::assertSame('John Doe', $templateResponse->getData()[0]->getAuthor());
        self::assertSame(1, $templateResponse->getCount());
        self::assertSame(1, $templateResponse->getTotal());
    }

    public function testGetTemplateDetailContent(): void
    {
        $response = new MockResponse(file_get_contents(__DIR__ . '/response_get_template_detail_content.json'));
        $client = new MockHttpClient($response);
        $templateApi = new TemplateApi(null, null, $client);
        $templateResponse = $templateApi->getTemplateDetailContent(new GetTemplateDetailContentRequest([
            'template_ID' => 42,
        ]));

        self::assertSame(
            'Dear passenger, welcome to Mailjet! May the delivery force be with you!',
            $templateResponse->getData()[0]->getTextPart()
        );
        self::assertSame(1, $templateResponse->getCount());
        self::assertSame(1, $templateResponse->getTotal());
    }
}
