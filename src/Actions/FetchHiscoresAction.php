<?php

namespace GeTracker\OsrsApi\Actions;

use GeTracker\OsrsApi\Support\HiscoreParser;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class FetchHiscoresAction implements \GeTracker\OsrsApi\Contracts\FetchHiscoresAction
{
    /** @var Client */
    private $client;

    /** @var HiscoreParser */
    private $hiscoreParser;

    private $apiUrl = 'https://secure.runescape.com/m=hiscore_oldschool/index_lite.ws?player=';

    public function __construct(HiscoreParser $hiscoreParser)
    {
        $this->client = new \GuzzleHttp\Client;
        $this->hiscoreParser = $hiscoreParser;
    }

    /**
     * {@inheritDoc}
     */
    public function fetch(string $username): \GeTracker\OsrsApi\DTO\Hiscore\HiscoreData
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
     * Make a request to the OSRS Hiscores API
     *
     * @param string $url
     *
     * @return string|null
     */
    private function makeApiRequest(string $url): ?string
    {
        try {
            $response = $this->client->request('GET', $url, [
                'connect_timeout' => 4,
                'timeout' => 4,
            ]);
        } catch (GuzzleException $e) {
            return null;
        } catch (\Exception $e) {
            return null;
        }

        return (string)$response->getBody();
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
}
