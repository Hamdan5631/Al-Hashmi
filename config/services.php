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

    'twilio' => [
        'test_mode' => env('TWILIO_TEST_MODE'),
        'test_mode_number' => env('TWILIO_TEST_MODE_NUMBER'),
        'sid' => env('TWILIO_SID'),
        'auth_token' => env('TWILIO_AUTH_TOKEN'),
        'number' => env('TWILIO_NUMBER'),
        'service_id' => env('TWILIO_MSG_SERVICE_ID'),
        'sandbox_whatsapp_number' => env('TWILIO_MSG_SANDBOX_WHATSAPP_NUMBER'),
        'whatsapp_from' => env('TWILIO_WHATSAPP_FROM'),
        'whatsapp_to' => env('TWILIO_WHATSAPP_TO'),
    ],
    'msg91' => [
        'auth_key' => env('MSG91_AUTH_KEY'),
        'sender_id' => env('MSG91_SENDER_ID'),
        'route' => env('MSG91_ROUTE', '4'),
        'country' => env('MSG91_COUNTRY', '91'),
        'template_id' => env('MSG91_TEMPLATE_ID'),
        'test_mode' => env('MSG91_TEST_MODE', false),
        'test_mode_number' => env('MSG91_TEST_MODE_NUMBER', '0000000000'),
    ],
    'static_otp_code' => env('STATIC_OTP_CODE'),
    'razorpay' => [
        'key' => env('RAZORPAY_KEY'),
        'secret' => env('RAZORPAY_SECRET')
    ],
];
