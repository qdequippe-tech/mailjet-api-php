<?php

namespace Qdequippe\Mailjet\Tests\SendEmail;

use PHPUnit\Framework\TestCase;
use Qdequippe\Mailjet\SendEmail\Attachment;
use Qdequippe\Mailjet\SendEmail\EmailAddress;
use Qdequippe\Mailjet\SendEmail\Message;
use Qdequippe\Mailjet\SendEmail\SendEmailRequest;

class SendEmailRequestTest extends TestCase
{
    public function testRequestBody(): void
    {
        $sendEmailRequest = new SendEmailRequest([
            'SandboxMode' => false,
            'Globals' => new Message([
                'From' => new EmailAddress([
                    'Email' => 'jane2.doe@example.com',
                    'Name' => 'Jane Doe',
                ]),
            ]),
            'Messages' => [
                new Message([
                    'From' => new EmailAddress([
                        'Email' => 'jane.doe@example.com',
                        'Name' => 'Jane Doe',
                    ]),
                    'To' => [
                        new EmailAddress([
                            'Email' => 'john.doe@example.com',
                            'Name' => 'John Doe',
                        ]),
                    ],
                    'Cc' => [
                        new EmailAddress([
                            'Email' => 'richard.doe@example.com',
                            'Name' => 'Richard Doe',
                        ]),
                    ],
                    'Bcc' => [
                        new EmailAddress([
                            'Email' => 'henry.doe@example.com',
                        ]),
                    ],
                    'Subject' => 'Hello World!',
                    'TextPart' => 'Hello World!',
                    'HTMLPart' => '<p>Hello World!</p>',
                    'Variables' => [
                        'key1' => 'value1',
                        'key2' => 'value2',
                    ],
                    'EventPayload' => 'Ticket,1234,row,15,seat,B',
                    'URLTags' => 'param1=1&param2=2',
                    'InlinedAttachments' => [
                        new Attachment([
                            'ContentType' => 'image/png',
                            'Filename' => 'logo.png',
                            'ContentID' => 'id1',
                            'Base64Content' => 'iVBORw0KGgoAAAANSUhEUgAAABQAAAALCAYAAAB/Ca1DAAAACXBIWXMAAA7EAAAOxAGVKw4bAAAAB3RJTUUH4wIIChcxurq5eQAAAAd0RVh0QXV0aG9yAKmuzEgAAAAMdEVYdERlc2NyaXB0aW9uABMJISMAAAAKdEVYdENvcHlyaWdodACsD8w6AAAADnRFWHRDcmVhdGlvbiB0aW1lADX3DwkAAAAJdEVYdFNvZnR3YXJlAF1w/zoAAAALdEVYdERpc2NsYWltZXIAt8C0jwAAAAh0RVh0V2FybmluZwDAG+aHAAAAB3RFWHRTb3VyY2UA9f+D6wAAAAh0RVh0Q29tbWVudAD2zJa/AAAABnRFWHRUaXRsZQCo7tInAAABV0lEQVQokaXSPWtTYRTA8d9N7k1zm6a+RG2x+FItgpu66uDQxbFurrr5OQQHR9FZnARB3PwSFqooddAStCBoqmLtS9omx+ESUXuDon94tnP+5+1JYm057GyQjZFP+l+S6G2FzlNe3WHtHc2TNI8zOlUUGLxsD1kDyR+EEQE2P/L8Jm/uk6RUc6oZaYM0JxtnpEX9AGPTtM6w7yzVEb61EaSNn4QD3j5m4QabH6hkVFLSUeqHyCeot0ib6BdNVGscPM/hWWr7S4Tw9TUvbpFUitHTnF6XrS+sL7O6VBSausT0FZonSkb+nZUFFm+z8Z5up5Btr1Lby7E5Zq4yPrMrLR263ZV52g+LvfW3iy6PXubUNVrnhqYNF3bmiZ1i1MmLnL7OxIWh4T+IMpYeRNyrRzyZjWg/ioh+aVgZu4WfXxaixbsRve5fiwb8epTo8+kZjSPFf/sHvgNC0/mbjJbxPAAAAABJRU5ErkJggg==',
                        ]),
                    ],
                ]),
                new Message([
                    'From' => new EmailAddress([
                        'Email' => 'jane.doe@example.com',
                        'Name' => 'Jane Doe',
                    ]),
                    'To' => [
                        new EmailAddress([
                            'Email' => 'ryan.doe@example.com',
                            'Name' => 'Ryan Doe',
                        ]),
                    ],
                    'Cc' => [
                        new EmailAddress([
                            'Email' => 'richard.doe@example.com',
                            'Name' => 'Richard Doe',
                        ]),
                    ],
                    'Bcc' => [
                        new EmailAddress([
                            'Email' => 'henry.doe@example.com',
                        ]),
                    ],
                    'Subject' => 'Hello Universe!',
                    'TextPart' => 'Hello Universe!',
                    'HTMLPart' => '<p>Hello Universe!</p>',
                    'TemplateID' => 42,
                    'TemplateLanguage' => true,
                    'CustomCampaign' => 'myCampaign',
                    'DeduplicateCampaign' => true,
                    'Headers' => [
                        'X-My-header' => 'X2332X-324-432-534',
                    ],
                    'CustomID' => 'PassengerTicket1234',
                    'Attachments' => [
                        new Attachment([
                            'ContentType' => 'text/plain',
                            'Filename' => 'test.txt',
                            'Base64Content' => 'VGhpcyBpcyB5b3VyIGF0dGFjaGVkIGZpbGUhISEK',
                        ]),
                    ],
                ]),
            ],
        ]);

        $expectedBody = [
            'Messages' => [
                [
                    'From' => [
                        'Email' => 'jane.doe@example.com',
                        'Name' => 'Jane Doe',
                    ],
                    'To' => [
                        [
                            'Email' => 'john.doe@example.com',
                            'Name' => 'John Doe',
                        ],
                    ],
                    'Cc' => [
                        [
                            'Email' => 'richard.doe@example.com',
                            'Name' => 'Richard Doe',
                        ],
                    ],
                    'Bcc' => [
                        [
                            'Email' => 'henry.doe@example.com',
                        ],
                    ],
                    'Subject' => 'Hello World!',
                    'TextPart' => 'Hello World!',
                    'HTMLPart' => '<p>Hello World!</p>',
                    'Variables' => [
                        'key1' => 'value1',
                        'key2' => 'value2',
                    ],
                    'EventPayload' => 'Ticket,1234,row,15,seat,B',
                    'URLTags' => 'param1=1&param2=2',
                    'InlinedAttachments' => [
                        [
                            'ContentType' => 'image/png',
                            'Filename' => 'logo.png',
                            'Base64Content' => 'iVBORw0KGgoAAAANSUhEUgAAABQAAAALCAYAAAB/Ca1DAAAACXBIWXMAAA7EAAAOxAGVKw4bAAAAB3RJTUUH4wIIChcxurq5eQAAAAd0RVh0QXV0aG9yAKmuzEgAAAAMdEVYdERlc2NyaXB0aW9uABMJISMAAAAKdEVYdENvcHlyaWdodACsD8w6AAAADnRFWHRDcmVhdGlvbiB0aW1lADX3DwkAAAAJdEVYdFNvZnR3YXJlAF1w/zoAAAALdEVYdERpc2NsYWltZXIAt8C0jwAAAAh0RVh0V2FybmluZwDAG+aHAAAAB3RFWHRTb3VyY2UA9f+D6wAAAAh0RVh0Q29tbWVudAD2zJa/AAAABnRFWHRUaXRsZQCo7tInAAABV0lEQVQokaXSPWtTYRTA8d9N7k1zm6a+RG2x+FItgpu66uDQxbFurrr5OQQHR9FZnARB3PwSFqooddAStCBoqmLtS9omx+ESUXuDon94tnP+5+1JYm057GyQjZFP+l+S6G2FzlNe3WHtHc2TNI8zOlUUGLxsD1kDyR+EEQE2P/L8Jm/uk6RUc6oZaYM0JxtnpEX9AGPTtM6w7yzVEb61EaSNn4QD3j5m4QabH6hkVFLSUeqHyCeot0ib6BdNVGscPM/hWWr7S4Tw9TUvbpFUitHTnF6XrS+sL7O6VBSausT0FZonSkb+nZUFFm+z8Z5up5Btr1Lby7E5Zq4yPrMrLR263ZV52g+LvfW3iy6PXubUNVrnhqYNF3bmiZ1i1MmLnL7OxIWh4T+IMpYeRNyrRzyZjWg/ioh+aVgZu4WfXxaixbsRve5fiwb8epTo8+kZjSPFf/sHvgNC0/mbjJbxPAAAAABJRU5ErkJggg==',
                            'ContentID' => 'id1',
                        ],
                    ],
                ],
                [
                    'From' => [
                        'Email' => 'jane.doe@example.com',
                        'Name' => 'Jane Doe',
                    ],
                    'To' => [
                        [
                            'Email' => 'ryan.doe@example.com',
                            'Name' => 'Ryan Doe',
                        ],
                    ],
                    'Cc' => [
                        [
                            'Email' => 'richard.doe@example.com',
                            'Name' => 'Richard Doe',
                        ],
                    ],
                    'Bcc' => [
                        [
                            'Email' => 'henry.doe@example.com',
                        ],
                    ],
                    'Subject' => 'Hello Universe!',
                    'TextPart' => 'Hello Universe!',
                    'HTMLPart' => '<p>Hello Universe!</p>',
                    'TemplateID' => 42,
                    'TemplateLanguage' => true,
                    'CustomCampaign' => 'myCampaign',
                    'DeduplicateCampaign' => true,
                    'Headers' => [
                        'X-My-header' => 'X2332X-324-432-534',
                    ],
                    'CustomID' => 'PassengerTicket1234',
                    'Attachments' => [
                        [
                            'ContentType' => 'text/plain',
                            'Filename' => 'test.txt',
                            'Base64Content' => 'VGhpcyBpcyB5b3VyIGF0dGFjaGVkIGZpbGUhISEK',
                        ],
                    ],
                ],
            ],
            'SandboxMode' => false,
            'Globals' => [
                'From' => [
                    'Email' => 'jane2.doe@example.com',
                    'Name' => 'Jane Doe',
                ],

            ],
        ];

        self::assertSame($expectedBody, $sendEmailRequest->requestBody());
    }
}
