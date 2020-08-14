<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],
    'google' => [
        'client_id' => "163630209922-fpn6bfhtgr1an1ahqo37bc9iuoopp2ka.apps.googleusercontent.com",
        'client_secret' => "IRQHy5CM-HBInrQzRBluyzs6",
        'redirect' => "https://noknok.qa/login/google/callback"
    ],
    'facebook' => [
        'client_id' => "2714676228810928",
        'client_secret' => "335094b948845974e9b037a0d4a1594d",
        'redirect' => "https://noknok.qa/login/facebook/callback"
    ],

];
