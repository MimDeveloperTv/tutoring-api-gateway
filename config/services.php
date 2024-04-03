<?php

return [

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
        'scheme' => 'https',
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'services' => [
        'core' => env('SERVICE_CORE','http://localhost'),
        //'userManagement' => env('SERVICE_USER_MANAGEMENT','http://localhost'),
    ],

    'domains' => [
        'core' => env('DOMAIN_CORE','http://localhost'),
    ],

    'credentials' => [
        'client' => env('CLIENT_CREDENTIAL_SECRET_KEY','http://localhost'),
    ]
];
