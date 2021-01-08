<?php

namespace GeTracker\OsrsApi\API;

use GeTracker\OsrsApi\Contracts\FetchHiscoresAction;

/**
 * @method GeApi ge()
 * @method FetchHiscoresAction hiscores()
 */
class OsrsApi
{
    private GeApi $geApi;

    private FetchHiscoresAction $fetchHiscoresAction;

    public function __construct(GeApi $geApi, FetchHiscoresAction $fetchHiscoresAction)
    {
        $this->geApi = $geApi;
        $this->fetchHiscoresAction = $fetchHiscoresAction;
    }

    public function __call($name, $arguments)
    {
        if ($name === 'ge') {
            return $this->geApi;
        }

        if ($name === 'hiscores') {
            return $this->fetchHiscoresAction;
        }

        return null;
    }
}
