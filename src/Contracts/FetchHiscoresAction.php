<?php

namespace GeTracker\OsrsApi\Contracts;

use GeTracker\OsrsApi\DTO\Hiscore\HiscoreData;

interface FetchHiscoresAction
{
    /**
     * Fetch the hiscores for `username` and return a formatted `HiscoreData` object
     *
     * @param string $username
     *
     * @return HiscoreData
     */
    public function fetch(string $username): HiscoreData;
}
