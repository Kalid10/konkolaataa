<?php

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Facades\Log;

class ChapaService
{
    protected $client;
    protected $secretKey;

    public function __construct()
    {
        $this->client = new Client([
            'timeout' => 20, // Increase the timeout to 20 seconds
        ]);
        $this->secretKey = config('services.chapa.secret_key');
    }

    public function initializePayment($amount, $currency, $email, $name, $phoneNumber, $txRef, $returnUrl)
    {
        $payload = [
            'amount' => $amount,
            'currency' => $currency,
            'email' => $email,
            'name' => $name,
            'phone_number' => $phoneNumber,
            'tx_ref' => $txRef,
            'return_url' => $returnUrl,
        ];

        try {
            $response = $this->client->post('https://api.chapa.co/v1/transaction/initialize', [
                'headers' => [
                    'Authorization' => 'Bearer ' . $this->secretKey,
                    'Content-Type' => 'application/json',
                ],
                'json' => $payload,
            ]);

            $responseBody = $response->getBody()->getContents();

            return json_decode($responseBody, true);
        } catch (RequestException $e) {
            Log::error('Chapa Initialization Error: ' . $e->getMessage());
            return null;
        }
    }

    public function verifyPayment($txRef)
    {
        try {
            $response = $this->client->get("https://api.chapa.co/v1/transaction/verify/{$txRef}", [
                'headers' => [
                    'Authorization' => 'Bearer ' . $this->secretKey,
                    'Content-Type' => 'application/json',
                ],
            ]);

            $responseBody = $response->getBody()->getContents();

            return json_decode($responseBody, true);
        } catch (RequestException $e) {
            Log::error('Chapa Verification Error: ' . $e->getMessage());
            return null;
        }
    }
}
