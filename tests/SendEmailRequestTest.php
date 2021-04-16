<?php

namespace Qdequippe\Mailjet\Test;

use Qdequippe\Mailjet\EmailAddress;
use Qdequippe\Mailjet\Message;
use Qdequippe\Mailjet\SendEmailRequest;
use PHPUnit\Framework\TestCase;

class SendEmailRequestTest extends TestCase
{
    public function testRequestBodySingleMessage(): void
    {
        $sendEmailRequest = new SendEmailRequest([
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
                        ])
                    ],
                    'Subject' => 'Hello World!',
                    'TextPart' => 'Hello World!',
                    'HTMLPart' => '<p>Hello World!</p>'
                ])
            ]
        ]);

        $expectedBody = [
            'Messages' => [
                [
                    'From' => [
                        'Email' => 'jane.doe@example.com',
                        'Name' => 'Jane Doe'
                    ],
                    'To' => [
                        [
                            'Email' => 'john.doe@example.com',
                            'Name' => 'John Doe',
                        ],
                    ],
                    'Subject' => 'Hello World!',
                    'TextPart' => 'Hello World!',
                    'HTMLPart' => '<p>Hello World!</p>',
                ]
            ],
        ];
        self::assertSame($expectedBody, $sendEmailRequest->requestBody());
    }

    public function testRequestBodySingleMessageWithCc(): void
    {
        $sendEmailRequest = new SendEmailRequest([
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
                        ])
                    ],
                    'Cc' => [
                        new EmailAddress([
                            'Email' => 'richard.doe@example.com',
                            'Name' => 'Richard Doe',
                        ])
                    ],
                    'Bcc' => [
                        new EmailAddress([
                            'Email' => 'henry.doe@example.com',
                        ])
                    ],
                    'Subject' => 'Hello World!',
                    'TextPart' => 'Hello World!',
                    'HTMLPart' => '<p>Hello World!</p>'
                ])
            ]
        ]);

        $expectedBody = [
            'Messages' => [
                [
                    'From' => [
                        'Email' => 'jane.doe@example.com',
                        'Name' => 'Jane Doe'
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
                ]
            ],
        ];
        self::assertSame($expectedBody, $sendEmailRequest->requestBody());
    }

    public function testRequestBodyMultipleMessage(): void
    {
        $sendEmailRequest = new SendEmailRequest([
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
                        ])
                    ],
                    'Subject' => 'Hello World!',
                    'TextPart' => 'Hello World!',
                    'HTMLPart' => '<p>Hello World!</p>'
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
                        ])
                    ],
                    'Subject' => 'Hello Universe!',
                    'TextPart' => 'Hello Universe!',
                    'HTMLPart' => '<p>Hello Universe!</p>',
                    'TemplateID' => 42
                ])
            ]
        ]);

        $expectedBody = [
            'Messages' => [
                [
                    'From' => [
                        'Email' => 'jane.doe@example.com',
                        'Name' => 'Jane Doe'
                    ],
                    'To' => [
                        [
                            'Email' => 'john.doe@example.com',
                            'Name' => 'John Doe',
                        ],
                    ],
                    'Subject' => 'Hello World!',
                    'TextPart' => 'Hello World!',
                    'HTMLPart' => '<p>Hello World!</p>',
                ],
                [
                    'From' => [
                        'Email' => 'jane.doe@example.com',
                        'Name' => 'Jane Doe'
                    ],
                    'To' => [
                        [
                            'Email' => 'ryan.doe@example.com',
                            'Name' => 'Ryan Doe',
                        ],
                    ],
                    'Subject' => 'Hello Universe!',
                    'TextPart' => 'Hello Universe!',
                    'HTMLPart' => '<p>Hello Universe!</p>',
                    'TemplateID' => 42
                ]
            ],
        ];
        self::assertSame($expectedBody, $sendEmailRequest->requestBody());
    }

    public function testRequestBodyWithVariables(): void
    {
        $sendEmailRequest = new SendEmailRequest([
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
                        ])
                    ],
                    'Subject' => 'Hello World!',
                    'TextPart' => 'Hello World!',
                    'HTMLPart' => '<p>Hello World!</p>',
                    'Variables' => [
                        'key1' => 'value1',
                        'key2' => 'value2',
                    ]
                ])
            ]
        ]);

        $expectedBody = [
            'Messages' => [
                [
                    'From' => [
                        'Email' => 'jane.doe@example.com',
                        'Name' => 'Jane Doe'
                    ],
                    'To' => [
                        [
                            'Email' => 'john.doe@example.com',
                            'Name' => 'John Doe',
                        ],
                    ],
                    'Subject' => 'Hello World!',
                    'TextPart' => 'Hello World!',
                    'HTMLPart' => '<p>Hello World!</p>',
                    'Variables' => [
                        'key1' => 'value1',
                        'key2' => 'value2',
                    ]
                ]
            ],
        ];

        self::assertSame($expectedBody, $sendEmailRequest->requestBody());
    }
}
