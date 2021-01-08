<?php

namespace GeTracker\OsrsApi\Support;

use Illuminate\Support\Facades\Http;

class HttpClient
{
    public const USER_AGENT = 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/87.0.4280.88 Safari/537.36';

    /**
     * Construct an Http Client using a configured User Agent
     *
     * @return \Illuminate\Http\Client\PendingRequest
     * @see \Illuminate\Support\Facades\Http
     */
    public static function getInstance(): \Illuminate\Http\Client\PendingRequest
    {
        return Http::withHeaders(['User-Agent' => self::USER_AGENT]);
    }
}
