<?php

namespace App\Handler\Msg91;

use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Facades\Log;
use Twilio\Exceptions\ConfigurationException;
use Twilio\Exceptions\TwilioException;
use GuzzleHttp\Client;

/**
 * @property Client $twilio
 */
class Msg91SmsProvider
{

    /**
     * @throws GuzzleException
     */

    public function send(string $phone, string $body): void
    {
        $authKey = config('services.msg91.auth_key');
        $templateId = config('services.msg91.template_id');

        $otpExpiry = 10;
        $realTimeResponse = 1;

        $client = new Client();

        $url = "https://control.msg91.com/api/v5/otp";

        $queryParams = [
            'otp_expiry' => $otpExpiry,
            'template_id' => $templateId,
            'mobile' => $phone,
            'authkey' => $authKey,
            'realTimeResponse' => $realTimeResponse,
        ];

        $response = $client->post($url, [
            'headers' => [
                'Content-Type' => 'application/json',
            ],
            'query' => $queryParams,
            'json' => [
                'otp' => $body,
            ]
        ]);

        $responseBody = json_decode($response->getBody()->getContents(), true);
        if ($responseBody['type'] !== 'success') {
            throw new \Exception('SMS sending failed: ' . $responseBody['message']);
        }
    }

}
