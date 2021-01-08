<?php

namespace GeTracker\OsrsApi\Actions;

use GeTracker\OsrsApi\DTO\Hiscore\HiscoreData;
use GeTracker\OsrsApi\Support\HiscoreParser;
use GeTracker\OsrsApi\Support\HttpClient;
use GuzzleHttp\Client;

class FetchHiscoresAction implements \GeTracker\OsrsApi\Contracts\FetchHiscoresAction
{
    private Client $client;

    private HiscoreParser $hiscoreParser;

    private string $apiUrl = 'https://secure.runescape.com/m=hiscore_oldschool/index_lite.ws?player=';

    public function __construct(HiscoreParser $hiscoreParser)
    {
        $this->client = new Client;
        $this->hiscoreParser = $hiscoreParser;
    }

    /**
     * {@inheritDoc}
     */
    public function fetch(string $username): HiscoreData
    {
        // Build the URL
        $url = $this->buildUrl(
            $this->sanitize($username)
        );

        return $this->hiscoreParser->parse(
            $this->formatRsn($username),
            $this->makeApiRequest($url)
        );
    }

    /**
     * Append sanitized username to the API URL
     *
     * @param string $username
     *
     * @return string
     */
    private function buildUrl(string $username): string
    {
        return $this->apiUrl . $username;
    }

    /**
     * Sanitize the username for use in a query string
     *
     * @param string $username
     *
     * @return string
     */
    private function sanitize(string $username): string
    {
        return urlencode(trim($username));
    }

    /**
     * Format the RSN to how it would appear in-game
     *
     * @param string $username
     *
     * @return string
     */
    public function formatRsn(string $username): string
    {
        return ucwords(
            trim(str_replace(['-', '_'], ' ', urldecode($username)))
        );
    }

    /**
     * Make a request to the OSRS Hiscores API
     *
     * @param string $url
     *
     * @return string|null
     */
    private function makeApiRequest(string $url): ?string
    {
        $response = HttpClient::getInstance()
            ->timeout(4)
            ->get($url);

        // We encountered an error when accessing the API
        if (!$response->successful()) {
            return null;
        }

        $body = $response->body();

        return !$this->requestFailed($body) ? $body : null;
    }

    /**
     * Determine if the request has actually failed.
     *
     * Checks the returned content for HTML. This is required as when the Hiscores API is offline, Jagex
     * returns an HTML page with HTTP status 200.
     *
     * @param string $body
     *
     * @return bool
     */
    private function requestFailed(string $body): bool
    {
        return strpos($body, '<html') !== false;
    }
}
