<?php

namespace App\Helpers;

use GuzzleHttp\Promise\PromiseInterface;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class SMS
{
    const SEND_SMS_URL = "https://api.afromessage.com/api/send";

    /**
     * @throws ConnectionException
     */
    public static function send(
        string $to,
        string $message
    ): PromiseInterface|Response
    {
        return Http::acceptJson()
            ->withToken(self::secretKey())
            ->post(self::SEND_SMS_URL, [
                'to' => $to,
                'message' => $message
            ]);
    }

    private static function secretKey(): string
    {
        // TODO: Move this to the .env file
        return 'eyJhbGciOiJIUzI1NiJ9.eyJpZGVudGlmaWVyIjoiVjJUTEtDTnh3M3liTlJYcFhIQ1RwWE1EWnI1OUdWelIiLCJleHAiOjE4Nzc5Mzg5MDksImlhdCI6MTcyMDE3MjUwOSwianRpIjoiZWU1ZTg0ZmQtNGZkZS00ZGFmLTg0YjUtNWE3YjdhZDI4MjJkIn0.zgzproic1x2LLXWfA2wnlbDuhAXiudYBrUiv09mxyPk';
    }
}

